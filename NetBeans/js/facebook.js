/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


window.fbAsyncInit = function() {
  FB.init({
    appId      : '716108815193082', //MUST BE CHANGED!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    xfbml      : true,
    version    : 'v2.5'
  });
};


//
(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
 // or include the following in 'head':
 // < script src="//connect.facebook.net/en_US/sdk.js" > < /script > 


$(document).ready(function(){
$('#fb_shareDemocrat').click(function(e){
  e.preventDefault();
  FB.ui(
    {
      method: 'feed',
      name: 'I reached the summit of Mt. Democrat!',
      link: 'http://coloradoyoungleaders.org/about-us/program/',
      picture: 'https://d3n8a8pro7vhmx.cloudfront.net/cyl/pages/813/attachments/original/1414432465/Mt.Democrat_OurCurriculum.png?1414432465'
      //caption: ''
      //description: 'Small description of the post'
    }
  );
});
});


$(document).ready(function(){
$('#fb_shareCameron').click(function(e){
  e.preventDefault();
  FB.ui(
    {
      method: 'feed',
      name: 'I reached the summit of Mt. Cameron!',
      link: 'http://coloradoyoungleaders.org/about-us/program/',
      picture: 'https://d3n8a8pro7vhmx.cloudfront.net/cyl/pages/813/attachments/original/1414432463/Mt.Cameron_OurCurriculum.png?1414432463'
      //caption: '',
      //description: 'Small description of the post',
    }
  );
});
});


$(document).ready(function(){
$('#fb_shareLincoln').click(function(e){
  e.preventDefault();
  FB.ui(
    {
      method: 'feed',
      name: 'I reached the summit of Mt. Lincoln!',
      link: 'http://coloradoyoungleaders.org/about-us/program/',
      picture: 'https://d3n8a8pro7vhmx.cloudfront.net/cyl/pages/813/attachments/original/1414432468/Mt.Lincoln_OurCurriculum.png?1414432468'
      //caption: ''
      //description: 'Small description of the post'
    }
  );
});
});


$(document).ready(function(){
$('#fb_shareBross').click(function(e){
  e.preventDefault();
  FB.ui(
    {
      method: 'feed',
      name: 'I reached the summit of Mt. Bross!',
      link: 'http://coloradoyoungleaders.org/about-us/program/',
      picture: 'http://www.coloradoyoungleaders.org/wp-content/uploads/2015/09/bross_headline.png'
      //caption: ''
      //description: 'Small description of the post'
    }
  );
});
});