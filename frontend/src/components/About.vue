<template>
    <center>
        <img src="https://lh3.googleusercontent.com/qpQx4rUDhjbpOBnzICQjKJPXQ_VvrN1SFpTZpALKbdt_Hd5EUQ8psQfFM9Ssd2Ys6_Gj7A649WRQQz46xu8J7nX9KE_rA06azfzR7YNe8nWAVai07J-wrjc3Hm87_2qevp2BOsk5alpCMJi4aMb6OGcnSR7K9fTJarR7cJHwc-OkbqBpqRXC_1XdzV4u5Bu47avjDoZBnlEcLgaVMdkSJbK-h0TzmgLaDuDcxUzAXfEKvEhl-nA2s4V8MBDprQ2uS600PXmPZQX262ZU-NT2VfHACJ7vjnm_OVgMFeB6PQiIx7NvKhobhERs-6WLe90nTBRD3ZE9XKe9idEtbX-UMDvwa-X_Ec44jPBHyMkx5dFT15EfB-U5cUYBQVxlvYqhZYangvegiSfV6N69MaN4LmVHe6XaV3P2m6ryQBDVRm-nRt0JgoFJSuUw3DZKHOSZtV6gvX9Fv3zgB63HM2_PuZGtQ-OJHf97TLDT7lEuy3Sqt6q7RQQ25QDuHBVJTJ5Ni0wlF7kfyj8zSYIOr7k8DOF3YvV8uPtd9i4Bhsr5Kc_n02OVyh8fkhH-PV9qkWpx8Fp6l7DErfMar5XBTnh-xSJ5nWiEIQyS5wktxBE=w656-h675-no"
             width = "100px"
             height = "100px"
             alt="">
        <h2>SmartTrainer</h2>
        <br>
        <h2>Version 1.0-beta</h2>
            <v-icon x-large @click = "redirect('https://www.facebook.com/waikovixstudio/')">fab fa-facebook-f</v-icon>
        <br>
        <v-icon x-large @click = "redirect('https://www.instagram.com/waikovixstudio/')">fab fa-instagram</v-icon>
        <br>
        <h3 class="grey--text">Copyright 2018, Waikovix Studio,inc.All right reserved</h3>

    </center>
</template>

<script>
    export default {
        name: "About",
        created(){
            this.$eventBus.$emit('close-modal');
        }
    }
</script>

<style scoped>
h3{
    height:30px;
    margin: 0;
    clear: both;
    width:100%;
    position: relative;
    bottom:0;
}
</style>