if (!/(Android|iPhone|iPod|Ipad|ios)/i.test(navigator.userAgent)) {
    
    var audio = new Audio(),
    $player = $("#wenkmPlayer"),
    $btns = $(".status", $player),
    $songName = $(".song", $player),
    $cover = $(".cover", $player),
 $songFrom=$('.player .artist',$player),
    $songFrom1 = $(".player .artist1", $player),
	$songFrom2 = $(".player .moshi", $player),
	$songFrom3 = $(".player .geci", $player),
	$songFrom4 = $(".player .gfx", $player),
	songFrom33 = "开启",
    songFrom44 = "",
    $songFrom = $(".player .artist", $player),
    $songFroma = $(".artista", $player),
    roundcolor = "#6c6971",
    lightcolor = "#81c300",
    playListFile = "plst.js",
    albumListId = 0,
    volume = 0.50,// 初始音量
	lrcshow = true,
    songListId = 0,
    songTotal = 0,
    songLength = 0;
    function wenkmCicle() {
        $(".time", $player).text(formatSecond(audio.currentTime) + " / " + formatSecond(audio.duration));
        if (audio.currentTime < audio.duration / 2) {
            $btns.css("background-image", "linear-gradient(90deg, " + roundcolor + " 50%, transparent 50%, transparent), linear-gradient(" + (90 + (270 - 90) / (audio.duration / 2) * audio.currentTime) + "deg, " + lightcolor + " 50%, " + roundcolor + " 50%, " + roundcolor + ")")
        } else {
            $btns.css("background-image", "linear-gradient(" + (90 + (270 - 90) / (audio.duration / 2) * audio.currentTime) + "deg, " + lightcolor + " 50%, transparent 50%, transparent), linear-gradient(270deg, " + lightcolor + " 50%, " + roundcolor + " 50%, " + roundcolor + ")")
        }
    }
    function formatSecond(t) {
        return ("00" + Math.floor(t / 60)).substr( - 2) + ":" + ("00" + Math.floor(t % 60)).substr( - 2)
    }
    $(".control b").bind("mousewheel",
    function(event, delta) {
        var dir = delta > 0 ? "Up": "Down",
        vel = Math.abs(delta);
        return false
    });
    var cicleTime = null;
    var wenkmMedia = {
        play: function() {
			
			
		
			
             $player.addClass("playing");
      cicleTime = setInterval(wenkmCicle, 800);
      wenkmTips.show("~键：播放/暂停，左右键：上/下歌曲！开始播放：" + wenkmList[albumListId].song_list[songListId].song_title);
      if (hasLrc) {
        lrcTime = setInterval(wenkmLrc.lrc.play, 500);
        $("#wenkmLrc").addClass("show")

      }
        },
        pause: function() {
            clearInterval(cicleTime);
            $player.removeClass("playing");
            wenkmTips.show("暂停播放.");
            if (hasLrc) {
                clearTimeout(lrcTime);
                $("#wenkmLrc").removeClass("show")
                
            }
        },
        error: function() {
            clearInterval(cicleTime);
            $player.removeClass("playing");
            wenkmTips.show("加载歌曲时遇到错误.")
        },
        seeking: function() {
            clearInterval(cicleTime);
            $player.removeClass("playing");
            wenkmTips.show("加载中...")
        },
        volumechange: function() {
            var vol = parseInt(audio.volume * 100);
            $(".volume-on", $player).width(vol + "%");
            wenkmTips.show("音量：" + vol + "/100")
        },
        xiamideCode: function(l) {
            var result = [],
            url = "";
            var line, rows, extra;
            l = l.trim();
            if (l === "") {
                return ""
            }
            line = Number(l[0]);
            rows = Math.floor((l.length - 1) / line);
            extra = (l.length - 1) % line;
            l = l.slice(1);
            for (i = 0; i < extra; i++) {
                result.push(l.slice((rows + 1) * i, (rows + 1) * (i + 1)))
            }
            for (i = 0; i < line - extra; i++) {
                result.push(l.slice((rows + 1) * extra + (rows * i), (rows + 1) * extra + (rows * i) + rows))
            }
            for (i = 0; i < rows + 1; i++) {
                for (j = 0; j < rows; j++) {
                    if (result[j] && result[j][i]) {
                        url = url + result[j][i]
                    }
                }
            }
            url = unescape(url).replace(/\^/g, "0");
            return url
        },
        getInfos: function(id) {
            songListId = id;
            $.ajax({
                url: "http://www.xiami.com/song/playlist/id/" + wenkmList[albumListId].song_list[songListId].song_id + "/cat/json?callback=?",
                dataType: "json",
                success: function(infos) {
                    wenkmList[albumListId].song_list[songListId].lrc_src = infos.data.trackList[0].lyric;
                    audio.src = wenkmMedia.xiamideCode(infos.data.trackList[0].location);
                    console.log('' + infos.data.trackList[0].title + ' - ' + infos.data.trackList[0].album_name)

                    $songName.text(infos.data.trackList[0].title);
                    $songFrom.text("" + infos.data.trackList[0].artist );
					$songFroma.text( "" + infos.data.trackList[0].album_name);
                    
                    $cover.addClass("changing");
                    var coverImg = new Image();
                    coverImg.src = infos.data.trackList[0].pic.replace(/\_\d\./, "_5.");
                    coverImg.onload = function() {
                        setTimeout(function() {
                            $cover.html(coverImg)
                        },
                        500);
                        setTimeout(function() {
                            $cover.removeClass("changing")
                        },
                        800)
                    };
					
                    coverImg.error = function() {
                        $cover.html("").removeClass("changing")
                    };
                    $(".list li", $player).eq(songListId).addClass("current").find(".artist").html("&nbsp;-&nbsp;" + infos.data.trackList[0].artist).parent().siblings().removeClass("current");
                    audio.volume = volume;
                    audio.play();
                    wenkmLrc.load()
                },
                error: function(a, b, c) {
                    alert(a + "-" + b + "-" + c);
                    wenkmMedia.pause()
                }
            })
        },
        getsongListId: function(n) {
            return n >= songTotal ? 0 : n < 0 ? songTotal - 1 : n
        },
        next: function() {
            if (random) {
                wenkmMedia.getInfos(parseInt(Math.random() * songTotal))
            } else {
                wenkmMedia.getInfos(wenkmMedia.getsongListId(songListId + 1))
            }
        },
        prev: function() {
            if (random) {
                wenkmMedia.getInfos(parseInt(Math.random() * songTotal))
            } else {
                wenkmMedia.getInfos(wenkmMedia.getsongListId(songListId - 1))
            }
        }
    };
    var wenkmTipsTime = null;
    var wenkmTips = {
        show: function(cont) {
            clearTimeout(wenkmTipsTime);
            $("#wenkmTips").text(cont).addClass("show");
			
            this.hide()
        },
    		hide:function(){
		wenkmTipsTime=setTimeout(function(){
			$('#wenkmTips').removeClass('show');
			
			0 == musicfirsttip && (musicfirsttip = !0, wenkmTips.show("~键：播放/暂停，左右键：上/下歌曲！"))
		},3000)
	}
};
    audio.addEventListener("play", wenkmMedia.play, false);
    audio.addEventListener("pause", wenkmMedia.pause, false);
    audio.addEventListener("ended", wenkmMedia.next, false);
    audio.addEventListener("playing", wenkmMedia.playing, false);
    audio.addEventListener("volumechange", wenkmMedia.volumechange, false);
    audio.addEventListener("error", wenkmMedia.error, false);
    audio.addEventListener("seeking", wenkmMedia.seeking, false);
    $(".switch-player", $player).click(function() {
        $player.toggleClass("show");
        $("#wenkmLrc").toggleClass("showPlayer")
    });
    $(".pause", $player).click(function() {
        audio.pause()
    });
    $(".play", $player).click(function() {
        audio.play()
    });
    $($player).on("mouseover", "i",
    function() {
        $(this).addClass("current1")
    }).on("mouseout", "i",
    function() {
        $(this).removeClass("current1")
    });
    $(".prev", $player).click(wenkmMedia.prev);
    $(".next", $player).click(wenkmMedia.next);
    $(".random", $player).click(function() {
        $(this).addClass("current");
        $(".loop", $player).removeClass("current");
        random = true;
        wenkmTips.show("随机播放")
        $songFrom2.html('<i class="random fa fa-random current"></i> 随机播放')
    });
    $(".loop", $player).click(function() {
        $(this).addClass("current");
        $(".random", $player).removeClass("current");
        random = false;
        wenkmTips.show("顺序播放")
        $songFrom2.html('<i class="loop fa fa-retweet"></i> 顺序播放')
    });

    var $progress = $(".progress", $player);
    $progress.click(function(e) {
        var progressWidth = $progress.width(),
        progressOffsetLeft = $progress.offset().left;
        volume = (e.clientX - progressOffsetLeft) / progressWidth;
        audio.volume = volume
    });
    var isDown = false;
    $(".drag", $progress).mousedown(function() {
        isDown = true;
        $(".volume-on", $progress).removeClass("ts5")
    });
    $(window).on({
        mousemove: function(e) {
            if (isDown) {
                var progressWidth = $progress.width(),
                progressOffsetLeft = $progress.offset().left,
                eClientX = e.clientX;
                if (eClientX >= progressOffsetLeft && eClientX <= progressOffsetLeft + progressWidth) {
                    $(".volume-on", $progress).width((eClientX - progressOffsetLeft) / progressWidth * 100 + "%");
                    volume = (eClientX - progressOffsetLeft) / progressWidth;
                    audio.volume = volume
                }
            }
        },
        mouseup: function() {
            isDown = false;
            $(".volume-on", $progress).addClass("ts5")
        }
    });
    $(".switch-playlist").click(function() {
        $player.toggleClass("showList")
    });
    $('.switch-musiclrc').click(function() {
        if (lrcshow) {
            lrcshow = false;
            $("#wenkmLrc").removeClass('show');
            $(".switch-musiclrc").removeClass('open');
        } else {
            lrcshow = true;
            $("#wenkmLrc").addClass('show');
            $(".switch-musiclrc").addClass('open');
        }
    });

    /*  注释掉 ajax 加载 列表部分 改 HTML 集成
  $.ajax({
    url: playListFile,
    type: "GET",
    dataType: "script",
    success: function() {
  */
    $(".header", $player).text(wenkmList[albumListId].song_album);
    songTotal = wenkmList[albumListId].song_list.length;
    var li = "";
    for (var i = 0; i < songTotal; i++) {
        li += '<li><span class="index">' + (i + 1) + "</span>" + wenkmList[albumListId].song_list[i].song_title + '<span class="artist"></span></li>'
    }
    $(".list", $player).html("<ul>" + li + "</ul>").mCustomScrollbar();
    wenkmMedia.getInfos(songListId);
    $(".list li", $player).click(function() {
        $(this).hasClass("current") || wenkmMedia.getInfos($(this).index())
    })
    /*
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      wenkmTips.show("歌曲列表获取失败.")
    }
  });
  */
    var hasLrc = false,
    lrcTimeLine = [],
    lrcHeight = $("#wenkmLrc").height(),
    lrcTime = null,
    letterTime1 = null,
    letterTime2 = null,
    tempNum1 = 0,
    tempNum2 = 0;
    var wenkmLrc = {
        load: function() {
            wenkmLrc.lrc.hide();
            $("#wenkmLrc").html("");
            hasLrc = false;
            lrc = wenkmList[albumListId].song_list[songListId].lrc_src;
            lrc_src = wenkmList[albumListId].song_list[songListId].lrc_src;

            if (typeof lrc_src != "undefined") {
                $.ajax({
                    url: lrc_src,
                    cache: false,
                    dataType: "text",
                    success: function(cont) {
                        setTimeout(function() {
                            wenkmLrc.lrc.format(cont)
                        },
                        500)
                    },
                    error: function() {
                        setTimeout(function() {
                            $("#wenkmLrc").html("")
                        },
                        500)
                    }
                })
            }
        },
        lrc: {
            format: function(cont) {
                hasLrc = true;
                function formatTime(t) {
                    var sp = t.split(':'),
                    min = +sp[0],
                    sec = +sp[1].split('.')[0],
                    ksec = +sp[1].split('.')[1];
                    return min * 60 + sec + Math.round(ksec / 100);
                };
                var lrcCont = cont.replace(/\[[A-Za-z]+:(.*?)]/g, '').split(/[\]\[]/g),
                lrcLine = '';
                lrcTimeLine = [];

                for (var i = 1; i < lrcCont.length; i += 2) {
                    var timer = formatTime(lrcCont[i]);
                    lrcTimeLine.push(timer);
                    if (i == 1) {
                        if (timer > 2) {
                            lrcLine += '<li class="wenkmLrc1 current">歌词加载中...</li>';
                            lrcLine += '<li class="wenkmLrc' + timer + '">' + lrcCont[i + 1] + '</li>';
                        } else {
                            lrcLine += '<li class="wenkmLrc' + timer + ' current">' + lrcCont[i + 1] + '</li>';
                        }
                    } else {
                        lrcLine += '<li class="wenkmLrc' + timer + '">' + lrcCont[i + 1] + '</li>'
                    }
                }
                //alert(lrcLine);
                $('#wenkmLrc').html('<ul>' + lrcLine + '</ul>');
                setTimeout(function() {
                    $('#wenkmLrc').addClass('show');
					
                },
                500);
                lrcTime = setInterval(wenkmLrc.lrc.play, 500)
            },
            play: function() {
                var timeNow = Math.round(audio.currentTime);
                if ($.inArray(timeNow, lrcTimeLine) > 0) {
                    var $lineNow = $(".wenkmLrc" + timeNow);
                    if (!$lineNow.hasClass("current")) {
                        $lineNow.addClass("current").siblings().removeClass("current");
                        $("#wenkmLrc").animate({
                            scrollTop: lrcHeight * $lineNow.index()
                        })
                    }
                }
            },
            hide: function() {
                clearInterval(lrcTime);
                $("#wenkmLrc").removeClass("show")
				
            }
        }
    }
};
	$(".switch-ksclrc").click(function() {
		$player.toggleClass("ksclrc"); 
		$("#wenkmLrc").toggleClass("hide");
		
		$("#wenkmKsc").toggleClass("hidePlayer");
		
		$("#wenkmLrc").hasClass("hide") ? (hasLrc && $songFrom3.html('<i class="fa fa-times-circle"></i> Lrc歌词关闭'), hasKsc && $songFrom3.html('<i class="fa fa-times-circle"></i> Ksc歌词关闭'), wenkmTips.show("歌词显示已关闭"), hasgeci = !1, songFrom33 = "关闭", $songFrom4.html('<i class="fa fa-toggle-off" title="打开歌词"></i>')) : (hasLrc && $songFrom3.html('<i class="fa fa-check-circle"></i> Lrc歌词开启'), hasKsc && $songFrom3.html('<i class="fa fa-check-circle"></i> Ksc歌词开启'), wenkmTips.show("开启歌词显示"), hasgeci = !0, songFrom33 = "开启", $songFrom4.html('<i class="fa fa-toggle-on" title="关闭歌词"></i>'));
		$("#wenkmPlayer i").each(function() {
			$("#tooltip").remove();
			if (this.title) {
				var a = this.title;
				$(this).mouseover(function(b) {
					this.title = "";
					$("body").append('<div id="tooltip">' + a + "</div>");
					$("#tooltip").css({
						left: b.pageX - 15 + "px",
						top: b.pageY + 30 + "px",
						opacity: "0.8"
					}).fadeIn(1)
				}).mouseout(function() {
					this.title = a;
					$("#tooltip").remove()
				}).mousemove(function(a) {
					$("#tooltip").css({
						left: a.pageX - 15 + "px",
						top: a.pageY + 30 + "px"
					})
				})
			}
		})
	});
//键盘事件
$(document).ready(function() {
	$(window).keydown(function(a) {
		a = a.keyCode;
		192 == a ? audio.paused ? (audio.play(), $(".list li", $player).eq(songId).addClass("current").find(".artist").html("正在播放&nbsp;>&nbsp;").parent().siblings().removeClass("current")) : (audio.pause(), $(".list li", $player).eq(songId).addClass("current").find(".artist").html("暂停播放&nbsp;>&nbsp;").parent().siblings().removeClass("current")) : 37 == a ? (wenkmMedia.prev(), $(".myhk_pjax_loading_frame,.myhk_pjax_loading").css("display", "block")) : 39 == a && (wenkmMedia.next(), $(".myhk_pjax_loading_frame,.myhk_pjax_loading").css("display", "block"))
	})
});

