#!/usr/bin/python3.4

import cx_Oracle

connstr='B489077/wlsghdyd@203.249.87.162:1521/orcl'

def select_menu():
    conn = cx_Oracle.connect(connstr)
    curs = conn.cursor()
    query = "select menu_no, menu_name from menu"
    curs.execute(query)
    return curs

def compare_user(member_id):
    conn = cx_Oracle.connect(connstr)
    curs = conn.cursor()
    query = "select count(member_id) as count from member where member_id = '{member_id}'".format(member_id = member_id)
    curs.execute(query)
    return curs