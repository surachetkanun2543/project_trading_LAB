<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>แบบฟอร์มติดต่อสอบถาม</title>
</head>

<body>
    <center><br>
        <b>แบบฟอร์มติดต่อสอบถาม<b></br></br>
                <form id="form1" name="form1" method="post" action="sendmail.php">
                    <table width="415" border="0" cellspacing="1" cellpadding="1">
                        <tr>
                            <td colspan="2"> </td>
                        </tr>
                        <tr>
                            <td>ชื่อ-นามสกุลผู้ส่ง</td>
                            <td><input name="name" type="text"></td>
                        </tr>
                        <tr>
                            <td>หัวข้อ</td>
                            <td><input name="subject" type="text" id="subject"></td>
                        </tr>
                        <tr>
                            <td valign="top">ข้อความ</td>
                            <td><textarea name="details" cols="30" rows="5" wrap="virtual" id="details"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div align="center"><input type="submit" name="Submit" value="Send Mail" />
                            </td>
                        </tr>
                    </table>
                </form>
    </center>
</body>

</html>