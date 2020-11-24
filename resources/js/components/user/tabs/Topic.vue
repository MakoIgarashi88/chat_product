<template>
    <v-card>
        <v-card-text>

            <v-badge overlap bordered content="99+" color="error">
                <v-avatar color="grey lighten-3">
                    <img
                        src="/favicon.ico"
                    >
                </v-avatar>
            </v-badge>
            <!-- this is second tabs -->
            <v-dialog v-model="dialog" width="500">
                <template v-slot:activator="{ on, attr }">
                    <v-btn v-bind="attr" v-on="on">open</v-btn>
                </template>
                <v-card>
                    <v-card-title>testing</v-card-title>
                    <v-card-text>hello</v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        text
                        @click="dialog = false"
                    >
                        I accept
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
  data () {
    return {
        dialog: false,
    }
  }
}
</script>

<style lang="scss" scoped>

</style>