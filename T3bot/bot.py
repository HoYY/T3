from telegram.ext import Updater, MessageHandler, Filters, CommandHandler, CallbackQueryHandler
from telegram import InlineKeyboardButton, InlineKeyboardMarkup
from db import DB


dbi = DB()
print('start telegram chat bot')
my_token = '1005755042:AAHry0MxoQp5NoZhUAUXkfJYPV22DEs2X7M'

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
        rows = dbi.select_menu()
        print(rows)
        for menu_no, menu_name in rows:
            show_list.append(InlineKeyboardButton(menu_name, callback_data=str(menu_no)+","+str(menu_name))) # add on button
        show_list.append(InlineKeyboardButton("cancel", callback_data="cancel")) # add cancel button
        show_markup = InlineKeyboardMarkup(build_menu(show_list, len(show_list) - 1)) # make markup
        bot.edit_message_text(text="주문하실 메뉴를 선택하세요", chat_id=update.callback_query.message.chat_id,
            message_id=update.callback_query.message.message_id, reply_markup=show_markup)
    elif call == 'qr' :
        print("qr")
        bot.edit_message_text(text="{}".format(dbi.select_qr()[0]),
            chat_id=update.callback_query.message.chat_id, message_id=update.callback_query.message.message_id)
    elif call == 'cancel' :
        print("cancel")
        bot.edit_message_text(text="취소하였습니다.", chat_id=update.callback_query.message.chat_id,
            message_id=update.callback_query.message.message_id)
        return
    else :
        print("insert order")
        set = call.split(',')
        dbi.insert_order(set[0],set[1])
        bot.edit_message_text(text="{}".format(dbi.select_qr()[0]),
            chat_id=update.callback_query.message.chat_id, message_id=update.callback_query.message.message_id)

# message reply function
def get_message(bot, update):
    if update.message.text.count('/') :
        set = update.message.text.split('/')
        rows = dbi.compare_user(set[0], set[1])
        if rows[0] == 1 :
            dbi.setMember_id(set[0])
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

start_handler = CommandHandler('start', start_command)
updater.dispatcher.add_handler(start_handler)

message_handler = MessageHandler(Filters.text, get_message)
updater.dispatcher.add_handler(message_handler)
updater.dispatcher.add_handler(CallbackQueryHandler(callback_get))

updater.start_polling(timeout=3, clean=True)
updater.idle()
