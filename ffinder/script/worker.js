var i = 0;

function clockFunction() {
   
   function clock(n) {
        return (n < 10) ? '0' + n : n;
   }

   var time = new Date();
   var hours = time.getHours();
   var minutes = time.getMinutes();
   var seconds = time.getSeconds();
   var timeofday = hours >= 12 ? 'PM' : 'AM'
   if (hours > 12) {
       hours -= 12;
   } else if (hours === 0) {
       hours = 12;
   }

   var todisplay = clock(hours) + ':' + clock(minutes) + ":" + clock(seconds)+ " " + clock(timeofday);
   postMessage(todisplay);
   setTimeout("clockFunction()",1000);
}

clockFunction();