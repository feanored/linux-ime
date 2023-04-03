
$(document).bind('pageinit', function(){
  // rodar pela primeira vez imediatamente
  setTime();
  setAge();

  setInterval("setTime();", 500);

  /*$(".tema").bind('click', function(){
    var id = $(this).attr("id").replace("t", "");
    // passando parametro de tempo para evitar caches
    $("#styles").attr("href", "css/tema"+id+".css?time="+getTime());    
    $.localStorage('style', id);
    return false;
  });

  //if($.localStorage('style'))
    //$("#styles").attr("href", "css/tema"+$.localStorage('style')+".css?time="+getTime());

  $("header nav a").bind('click', function(){
    alert($(this).parent().parent().attr("id"));
    if($($(this).attr("href")).find(".section_content").css("display") == "block")
      $($(this).attr("href")).find(".section_content").hide();
    else {
      $(".section_content").hide();
      $($(this).attr("href")).find(".section_content").show();
    }
  });*/

});

function checkTime(i) {
  if (i < 10)
    i = "0" + i;
  return i;
}

function getTime() {
  var today, d, me, y, h, mi, s;

  today = new Date();
  d = today.getDate();
  me = today.getMonth() + 1;
  y = today.getFullYear();
  h = today.getHours();
  mi = today.getMinutes();
  s = today.getSeconds();

  h = checkTime(h);
  mi = checkTime(mi);
  s = checkTime(s);
  d = checkTime(d);
  me = checkTime(me);

  return d+'/'+me+'/'+y+' '+h+':'+mi+':'+s;
}

function getAge() {
  var today, y, m, d, y90;

  today = new Date();
  y90 = new Date("01/16/1990");

  y = today.getFullYear() - y90.getFullYear();
  m = today.getMonth() - y90.getMonth();
  d = today.getDate() - y90.getDate();

  if(m <= 0 && d < 0)
    y--;

  return y;
}

function setTime() {
  $('.time').html(getTime());
}

function setAge() {
  $("#age").html(getAge());
}