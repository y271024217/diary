 $(document).ready(function(){

                	  var myPlaylist = new jPlayerPlaylist({
                	    jPlayer: "#jplayer_N",
                	    cssSelectorAncestor: "#jp_container_N"
                	  }, [
                	<?php foreach ($APP as $API){?> 
                	    {
                	      title:"<?php echo $API['title'];?>",
                	      artist:"<?php echo $API['athor'];?>",
                	      mp3:"<?php echo $API['rlink'];?>",
                	      poster: "images/m0.jpg"
                	    },
                	    <?php }?>
                	  ], {
                	    playlistOptions: {
                	      enableRemoveControls: true,
                	      autoPlay: true
                	    },
                	    swfPath: "js/jPlayer",
                	    supplied: "webmv, ogv, m4v, oga, mp3",
                	    smoothPlayBar: true,
                	    keyEnabled: true,
                	    audioFullScreen: false
                	  });
                	  
                	  $(document).on($.jPlayer.event.pause, myPlaylist.cssSelector.jPlayer,  function(){
                	    $('.musicbar').removeClass('animate');
                	    $('.jp-play-me').removeClass('active');
                	    $('.jp-play-me').parent('li').removeClass('active');
                	  });

                	  $(document).on($.jPlayer.event.play, myPlaylist.cssSelector.jPlayer,  function(){
                	    $('.musicbar').addClass('animate');
                	  });

                	  $(document).on('click', '.jp-play-me', function(e){
                	    e && e.preventDefault();
                	    var $this = $(e.target);
                	    if (!$this.is('a')) $this = $this.closest('a');

                	    $('.jp-play-me').not($this).removeClass('active');
                	    $('.jp-play-me').parent('li').not($this.parent('li')).removeClass('active');
                	    
                	    $this.toggleClass('active');
                	    $this.parent('li').toggleClass('active');
                	    if( !$this.hasClass('active') ){
                	      myPlaylist.pause();
                	    }else{
                	      myPlaylist.play($this.attr('data-num'));//开始播放，将代码开始执行
                	    }
                	    
                	  });


                	});