<template>
    <v-card outlined>
        <v-card-text>
            <v-row justify="center">
                <v-col cols="auto">
                    <IconLg :src="image" />
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col cols="12" sm="auto" class="text-sm-end">
                    ルーム名 : 
                </v-col>
                <v-col cols="12" sm="auto">
                    <v-textarea auto-grow outlined rows="1" row-height="15" hide-details></v-textarea>
                </v-col>
            </v-row>
            <v-row>
                <v-col class="text-center">
                    <v-btn color="primary">招待</v-btn>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data () {
        return {
            image: '/storage/images/Z4Wm6pZfqcoD6Hu1.png',
        }
    },
}
</script>