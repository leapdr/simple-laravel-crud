<template>
	<video class="video-js vjs-big-play-centered" controls preload="auto" ref="video-player">
		<source :src="src" type="application/x-mpegURL">
	</video>
</template>

<script>
	import videojs from 'video.js';

	export default {
    props: ["src"],
    data() {
      return {
        player: null
      }
    },
    mounted() {
      const element = this.$refs['video-player']

      this.player = videojs(element, { 
        fluid: true 
      });
    }
	}
</script>
