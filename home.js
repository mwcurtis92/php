/*
 Just a little script to make the picture on the homepage change every four seconds.
*/

var currentImage = 0;
window.onload = timer;

function displayImage()
{
   var imgWindow = document.getElementById('SIPLeft');
   switch(currentImage)
   {
      case 0:
         document.getElementById("scrollImg").src = "student1.jpg";
         currentImage++;
      break;
      case 1:
         document.getElementById("scrollImg").src = "student2.jpg";
         currentImage = 0;
         break;
   }
   
}

function timer()
{
   setInterval(displayImage, 4000);
}