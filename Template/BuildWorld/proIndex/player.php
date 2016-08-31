<!-- MP4播放器 -->
<!--  <div id="jplayer_1" class="jp-jplayer jp-video"></div>
<div class="jp-gui">
<div class="jp-video-play">
<a class="fa fa-5x text-white fa-play-circle"></a>
</div>
<div class="jp-interface bg-info padder">
<div class="jp-controls">
<div>
<a class="jp-play"><i class="icon-control-play i-2x"></i></a>
<a class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
</div>
<div class="jp-progress">
<div class="jp-seek-bar dker">
<div class="jp-play-bar dk">
</div>
<div class="jp-title text-lt">
<ul>
<li></li>
</ul>
</div>
</div>
</div>
<div class="hidden-xs hidden-sm jp-current-time text-xs text-muted"></div>
<div class="hidden-xs hidden-sm jp-duration text-xs text-muted"></div>
<div class="hidden-xs hidden-sm">
<a class="jp-mute" title="mute"><i class="icon-volume-2"></i></a>
<a class="jp-unmute hid" title="unmute"><i class="icon-volume-off"></i></a>
</div>
<div class="hidden-xs hidden-sm jp-volume">
<div class="jp-volume-bar dk">
<div class="jp-volume-bar-value lter"></div>
</div>
</div>
<div>
<a class="jp-full-screen" title="full screen"><i class="fa fa-expand"></i></a>
<a class="jp-restore-screen" title="restore screen"><i class="fa fa-compress text-lt"></i></a>
</div>
</div>
</div>
</div>  -->
<!-- . /MP4播放器 -->

<!--M3U8代码开始-->
<?php if (in_array($ext, $m3u8)){?>
<div class="video" id="HLSPlayer" >
<SCRIPT LANGUAGE=JavaScript>
var vID        = ""; 
var vWidth     = "100%";                //播放器宽度设置
var vHeight    = 469;                   //播放器宽度设置
var vPlayer    = "<?php echo TEMP_URL;?>/play/m3u8/s.swf"; //播放器文件
var vHLSset    = "<?php echo TEMP_URL;?>/play/m3u8/HLS.swf";             //HLS配置
var vPic       = "<?php echo TEMP_URL;?>/images/video.jpg";    //视频缩略图
var vCssurl    = "<?php echo TEMP_URL;?>/play/m3u8/images/mini.css";     //移动端CSS应用文件
var vHLSurl    = "<?php echo $video[rlink];?>";
</SCRIPT> 
<script type="text/javascript" src="<?php echo TEMP_URL;?>/play/m3u8/js/hls.min.js"></script>
</div>
<?php }?>
<!--M3U8代码结束-->

<!-- 多功能播放器 -->
<?php if (in_array($ext, $mp4_video)){?>
<div id="a1"></div>
<script type="text/javascript"
	src="<?php echo TEMP_URL;?>/play/GO_Player/ckplayer/ckplayer.js"
	charset="utf-8"></script>
<script type="text/javascript">
var flashvars={
    f:'<?php echo $video[rlink];?>',
    c:0,
    i:'<?php echo TEMP_URL;?>/images/video.jpg',
    e:5,
    k:160,
    my_url:encodeURIComponent(window.location.href),
    my_title:encodeURIComponent(document.title),
    loaded:'loadedHandler',
    b:0
};
var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
var video=['http://movie.ks.js.cn/flv/other/1_0.mp4->video/mp4'];
CKobject.embed('<?php echo TEMP_URL;?>/play/GO_Player/ckplayer/ckplayer.swf','a1','ckplayer_a1','100%','469',false,flashvars,video,params);
//function ckmarqueeadv(){return '我唯一锲而不舍，愿意以自己的生命去努力的，只不过是保守我个人的心怀意念，在我有生之日，做一个真诚的人，不放弃对生活的热爱和执着，在有限的时空里，过无限广大的日子。'};
</script>
<?php }?>
<!-- / 多功能播放器 -->
<?php if (in_array($ext, $flash_video)){?>
<!-- flash 播放器代码 -->
<embed type="application/x-shockwave-flash" class="edui-faked-video"
	pluginspage="http://www.macromedia.com/go/getflashplayer"
	src="<?php echo $video[rlink];?>"
	width="100%" height="469" wmode="transparent" play="true" loop="false"
	menu="false" allowscriptaccess="never" allowfullscreen="true" />
<?php }?>
<!-- flash 播放器代码 -->


<!--mp4视频播放器PlayerLite/代码开始--
<script type="text/javascript" src="<?php echo TEMP_URL;?>/play/mp4_new/images/swfobject.js"></script>
<div class="video" id="CuPlayer" style="950px;margin:0 auto;">
	<strong>我爱播放器(52player.com) 提示：您的Flash Player版本过低，请<a href="http://www.52player.com/">点此进行网页播放器升级</a>！</strong></div>
<script type="text/javascript">
var so = new SWFObject("<?php echo TEMP_URL;?>/play/mp4_new/PlayerLite.swf","CuPlayerV4","520","325","9","#000000");
so.addParam("allowfullscreen","true");
so.addParam("allowscriptaccess","always");
so.addParam("wmode","opaque");
so.addParam("quality","high");
so.addParam("salign","lt");
so.addVariable("videoDefault","http://vodcdn.video.taobao.com/oss/ali-video/e957a39cad808a7fd96b872c00cd0155/video.mp4"); //视频文件地址
so.addVariable("autoHide","true");
so.addVariable("hideType","fade");
so.addVariable("autoStart","false");
so.addVariable("holdImage","<?php echo TEMP_URL;?>/images/video.jpg");
so.addVariable("startVol","60");
so.addVariable("hideDelay","60");
so.addVariable("bgAlpha","75");
so.write("CuPlayer");
</script>
--,mp4视频播放器PlayerLite/代码结束-->