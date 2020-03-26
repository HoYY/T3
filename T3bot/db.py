import cx_Oracle
import datetime
import random


class DB:
    def __init__(self):
        self.__connstr = 'c##hoyy/1234@localhost:1521/cafeteria'
        self.__member_id = ""

    def insert_order(self, menu_no, menu_name):
        try:
            today = datetime.datetime.today()
            conn = cx_Oracle.connect(self.__connstr)
            curs = conn.cursor()
            query = "insert into orderlist(order_number, menu_no, menu_name, member_id, order_quantity, order_date) values(:order_number, :menu_no, :menu_name, :member_id, '1', :today)"
            curs.execute(query, order_number=random.randrange(1,10001), menu_no=menu_no, menu_name=menu_name, member_id=self.__member_id, today=today.strftime('%Y/%m%d'))
            conn.commit()
            conn.close()
        except Exception as e:
            print(e)

    def setMember_id(self, member_id):
        self.__member_id = member_id

    def select_qr(self):
        try:
            conn = cx_Oracle.connect(self.__connstr)
            curs = conn.cursor()
            query = "select qr_code from qrcode where member_id = '{member_id}'".format(member_id = self.__member_id)
            curs.execute(query)
            rows = curs.fetchone()
            conn.close()
            return rows
        except Exception as e:
            print(e)

    def select_menu(self):
        try:
            conn = cx_Oracle.connect(self.__connstr)
            curs = conn.cursor()
            query = "select menu_no, menu_name from menu"
            curs.execute(query)
            rows = curs.fetchmany()
            conn.close()
            return rows
        except Exception as e:
            print(e)

    def compare_user(self, member_id, password):
        try:
            conn = cx_Oracle.connect(self.__connstr)
            curs = conn.cursor()
            query = "select count(member_id) from member where member_id = '{member_id}' and password = '{password}'".format(member_id = member_id, password = password)
            curs.execute(query)
            rows = curs.fetchone()
            conn.close()
            return rows
        except Exception as e:
            print(e)