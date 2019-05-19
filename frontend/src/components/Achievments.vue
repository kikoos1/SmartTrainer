<template>
    <v-container grid-list-sm fluid align-content-center>
        <v-layout row wrap>
            <v-flex d-flex xs12 sm6 md4>
                <v-card v-for = '(item,id) in achievments' :key = 'id'>
                    <v-card-media
                            :src="item.img"
                            height="300px"
                            width="400px"
                    >
                    </v-card-media>

                    <v-card-title primary-title>
                        <div>
                            <div class="headline">{{item.title}}</div>
                        </div>
                    </v-card-title>
                    <v-slide-y-transition>
                        <v-card-text >
                           {{item.content}}
                        </v-card-text>
                    </v-slide-y-transition>
                </v-card>
            </v-flex>
        </v-layout>

    </v-container>
</template>

<script>
    export default {
        name: "Achievments",
        data:()=>({
            achievments:[{id:0,img:"https://lh3.googleusercontent.com/rRaH8NDquVnO6BzY1yCS3Q6WlAJwPOKJu5-jlXELkxy5phG4wpgnciHDjA_wF0Q8lwKG5BpZT4n6lkeBCkMCyzyhjIFfLVCN282tIVTf1REdmZv649sOXe9oLErLn6-EcbmhEywUQ5xPWyC6_VOqfhQwQk5zNEmzerVsRCLRSHk_Vm1fZ8so4L7rHwDtJfJv0AUW2u3kedn-yn8frctdzhpxTinau_C7mVn5IQ47CkoR4JcLFgVIi3dcVx7Cv3zx2wKAleDZYLOhbQ4XS5a4MJa0dkiDJ7Ia0rzFLRFLuDC7Jh7ADqGBF5vsAGjLgz8Yq16s9A7dtwEpSyM9QBKyKXtse0EVtHUocdg-4v1fo5Kuvxzb8Bh_SRhLWYZWDHLDGlSUrk7ebLHBks9n0yGgoAYI90jFc57esJ9550hDxFGYrlgitUZMLchiznhUOspWldB27vW5X5bga6CsamxEJKb8cz_p0NLW2T41tzk5XXVzAB_6nZ3B36WrubfEmczx2j8wgDavqWbA0TPCc91alN02zArMhsFPqWxSFXblWWeB4wYmDrVlnqF4z6PK3BM6Pfh74-y82PWafvytYOeSznWenmoKxj8antWw0EY=s501-no",
            title:'Ти промени своя живот!',
            content:'Ти направи първата стъпка към промяната на своя живот!L'}]
        }),
        created(){
            this.get('/achievments').then(function (resp) {
                console.log(resp)
            })
        }
    }
</script>

<style scoped>

</style>