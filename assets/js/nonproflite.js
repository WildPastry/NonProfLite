console.log("ts connected..."),$(document).on("mouseenter",".tile",function(){$(this).find(".tile-colour").toggle()}),$(document).on("mouseleave",".tile",function(){$(this).find(".tile-colour").toggle()});var mobileMenu=document.getElementById("menuControl");console.log(mobileMenu),$(mobileMenu).click(function(){$(".menuModuleWrap").toggleClass("showMenu")});