function hmsg()
        {
                    var h=new Date();
                    var hours=h.getHours();
                    var minutes=h.getMinutes();
                    var seconds=h.getSeconds();
                    var dn="AM";
                    if (hours>12)
                    {
                        dn="PM";
                        hours=hours-12;
                    }
                    if (hours==0)
                         hours=12;
                    if (minutes<=9)
                         minutes="0"+minutes;
                    if (seconds<=9)
                         seconds="0"+seconds;
                         myclock=hours+":"+minutes+":"+seconds+" "+dn;
                    if (document.layers)
                    {
                        document.getElementById("hora_despacho").value=myclock;
                    }
                    else if (document.all)
                              hora_despacho.value=myclock;
                                else if (document.getElementById)
                                            document.getElementById("hora_despacho").value=myclock;
                                            setTimeout("hmsg()",1000);
        }