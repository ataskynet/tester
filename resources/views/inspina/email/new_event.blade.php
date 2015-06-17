<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>info@skoolspace.com</title>

</head>

<body>

<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="content-wrap">
                            <table  cellpadding="0" cellspacing="0">
                                <!--<tr>
                                    <td>
                                        <img class="img-responsive" src="{{ asset('inspina/email_templates/img/header.jpg') }}"/>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td class="content-block">
                                        <h3>HI ,{{ $groupName }} member</h3>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        There is a new event: <b>{{ $event_name }}</b> <br/>You can attend this event by mark on the attending button and take part in the
                                        funfair activities of the event.<br/> <b>Event Description</b> <br/> {{ $event_description }} <br/> You can visit the event by clicking on the link below.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <br/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block aligncenter">
                                        <a href="{{ $link }}" class="btn-primary">Visit the new event</a>
                                    </td>
                                </tr>
                              </table>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table width="100%">
                        <tr>
                            <td class="aligncenter content-block">Group Mail from <a href="{{ url('/') }}"> info@skoolspace.com</a></td>
                        </tr>
                    </table>
                </div></div>
        </td>
        <td></td>
    </tr>
</table>

</body>
</html>
