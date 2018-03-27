## PHP Script to Serve Files and then Block users

This script was used for [LearnMean.com](http://learnmean.com/#!/) to proccess payments from paypal then serve a zip folder to the user, and then add them to the blocked.csv file so they wont be able to download the file more then once.

The `$SECRETKEY` is stored when you create a [paypal button](https://www.paypal.com/us/cgi-bin/webscr?cmd=_singleitem-intro-outside)

The `$FILELOCATION` is where the file you want to serve is located on the server.

If you want to use pretty urls configure your server to use the `.htaccess` provided. 
