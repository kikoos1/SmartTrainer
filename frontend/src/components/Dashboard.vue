<template>
    <v-layout>
        <v-flex xs12 sm6 offset-sm3>
            <v-card>
                <v-card-title primary-title>
                    <div class="text-xs-center">
                        <calorie-widget></calorie-widget>
                    </div>
                </v-card-title>

                <v-card-actions>
                    <v-btn flat color="blue" to = '/daily-intake'>Научи повече</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "Dashboard"
    }
</script>

<style scoped>

</style>