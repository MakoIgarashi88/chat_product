<template>
    <v-card>
        <v-row justify="center">
            <v-col cols="11">
                <v-card outlined>
                    <v-list two-line>
                        <v-list-item-group v-model="selected" active-class="pink--text">
                            <template v-for="(group, index) in mp_groups">
                                <v-list-item :key="group.name">
                                    <template>
                                        <v-row>
                                            <v-col cols="2" class="text-center">
                                                <v-badge overlap bordered content="6" color="error">
                                                    <IconSm :src="group.image_name"/>
                                                </v-badge>
                                            </v-col>
                                            <v-col cols="10">
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="group.name"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-col>
                                        </v-row>
                                    </template>
                                </v-list-item>
                                <v-divider v-if="index < mp_groups.length - 1" :key="index"></v-divider>
                            </template>
                        </v-list-item-group>
                    </v-list>
                    <v-divider></v-divider>

                    <PageNation :page="page" :pageCount="pageCount" />
                </v-card>
            </v-col>
        </v-row>
        <v-card-text>
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
import { mapState } from 'vuex'
export default {
    data () {
        return {
            page: 1,
            pageCount: 5,
            dialog: false,
            selected: [2],
        }
    },
    computed: mapState([ 'mp_groups' ])
}
</script>

<style lang="scss" scoped>

</style>