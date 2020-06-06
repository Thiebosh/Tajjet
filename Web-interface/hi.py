#!C:/Users/Thibaut Juzeau/AppData/Local/Programs/Python/Python36/python.exe


import sys

# headers
print("content-type: text/plain\n") #ou text/html

print("<html>")
print("<head>")
print("<title>CGI Test of Python</title>")
print("</head>")
print("<body>")

print("<B>hello python</B><br>")
print("executable path : "+sys.executable+"<br>")

print("</body>")
print("</html>")


f= open("guru99.txt","w+")
for i in range(2):
    f.write("This is line %d\r\n" % (i+1))
f.close()


sys.exit('exit message or value')
