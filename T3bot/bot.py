from telegram.ext import Updater, MessageHandler, Filters, CommandHandler, CallbackQueryHandler
import cx_Oracle
from telegram import InlineKeyboardButton, InlineKeyboardMarkup
import random
import datetime

connstr='B489077/wlsghdyd@203.249.87.162:1521/orcl'
member_id = 'test'

def insert_order(menu_no, menu_name):
    today = datetime.datetime.today()
    conn = cx_Oracle.connect(connstr)
    curs = conn.cursor()
    print(member_id)
    query = "insert into orderlist(order_number, menu_no, menu_name, member_id, order_quantity, order_date) values(:order_number, :menu_no, :menu_name, :member_id, '1', :today)"
    curs.execute(query, order_number=random.randrange(1,10001), menu_no=menu_no, menu_name=menu_name, member_id=member_id, today=today.strftime('%Y/%m%d'))
    conn.commit()
    conn.close()

def select_qr():
    conn = cx_Oracle.connect(connstr)
    curs = conn.cursor()
    query = "select qr_code from qrcode where member_id = '{member_id}'".format(member_id = member_id)
    curs.execute(query)
    rows = curs.fetchone()
    conn.close()
    return rows

def select_menu():
    conn = cx_Oracle.connect(connstr)
    curs = conn.cursor()
    query = "select menu_no, menu_name from menu"
    curs.execute(query)
    rows = curs.fetchmany()
    conn.close()
    return rows

def compare_user(member_id, password):
    conn = cx_Oracle.connect(connstr)
    curs = conn.cursor()
    query = "select count(member_id) from member where member_id = '{member_id}' and password = '{password}'".format(member_id = member_id, password = password)
    curs.execute(query)
    rows = curs.fetchone()
    conn.close()
    return rows

def build_menu(buttons, n_cols, header_buttons=None, footer_buttons=None):
    menu = [buttons[i:i + n_cols] for i in range(0, len(buttons), n_cols)]
    if header_buttons:
        menu.insert(0, header_buttons)
    if footer_buttons:
        menu.append(footer_buttons)
    return menu

def callback_get(bot, update):
    print("callback")
    call = update.callback_query.data
    if call == 'order' :
        print("order")
        show_list = []
        rows = select_menu()
        for menu_no, menu_name in rows:
            show_list.append(InlineKeyboardButton(menu_name, callback_data=str(menu_no)+","+str(menu_name))) # add on button
        show_list.append(InlineKeyboardButton("cancel", callback_data="cancel")) # add cancel button
        show_markup = InlineKeyboardMarkup(build_menu(show_list, len(show_list) - 1)) # make markup
        bot.edit_message_text(text="주문하실 메뉴를 선택하세요", chat_id=update.callback_query.message.chat_id,
            message_id=update.callback_query.message.message_id, reply_markup=show_markup)        
    elif call == 'qr' :
        print("qr")
        bot.edit_message_text(text="{}".format(select_qr()[0]),
            chat_id=update.callback_query.message.chat_id, message_id=update.callback_query.message.message_id)
    elif call == 'cancel' :
        print("cancel")
        bot.edit_message_text(text="취소하였습니다.", chat_id=update.callback_query.message.chat_id,
            message_id=update.callback_query.message.message_id)
        return
    else :
        print("callback2")
        set = call.split(',')
        insert_order(set[0],set[1])
        bot.edit_message_text(text="{}".format(select_qr()[0]),
            chat_id=update.callback_query.message.chat_id, message_id=update.callback_query.message.message_id)

my_token = '660586733:AAEipeLACHKrTgK3Gru_Tt0oyUEx4C13giw'

print('start telegram chat bot')
# message reply function
def get_message(bot, update):
    if update.message.text.count('/') :
        set = update.message.text.split('/')
        rows = compare_user(set[0], set[1])
        if rows[0] == 1 :
            global member_id
            member_id = set[0]
            show_list = []
            show_list.append(InlineKeyboardButton("주문하기", callback_data="order")) # add on button
            show_list.append(InlineKeyboardButton("QRcode", callback_data="qr")) # add on button
            show_list.append(InlineKeyboardButton("cancel", callback_data="cancel")) # add cancel button
            show_markup = InlineKeyboardMarkup(build_menu(show_list, len(show_list) - 1)) # make markup
            update.message.reply_text("메뉴를 선택하세요", reply_markup=show_markup)
        else :
            update.message.reply_text("잘못된 아이디 입니다.")
    else :
        update.message.reply_text("id/pw 꼴로 입력해주세요.")

def start_command(bot, update) :
    update.message.reply_text("T3 아이디(id/pw)를 적어주세요.")

updater = Updater(my_token)

message_handler = MessageHandler(Filters.text, get_message)
updater.dispatcher.add_handler(message_handler)
updater.dispatcher.add_handler(CallbackQueryHandler(callback_get))

start_handler = CommandHandler('start', start_command)
updater.dispatcher.add_handler(start_handler)

updater.start_polling(timeout=3, clean=True)
updater.idle()
