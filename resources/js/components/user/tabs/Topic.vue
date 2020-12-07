<template>
    <v-card>
        <v-row justify="center">
            <v-col cols="11">
                <v-card outlined>
                    <v-list two-line>
                        <v-list-item-group v-model="selected" active-class="pink--text">
                            <template v-for="(topic, index) in mp_f_topics">
                                <v-list-item :key="topic.name">
                                    <template>
                                        <v-list-item-avatar>
                                          	<IconSm :src="topic.image_name" />
                                        </v-list-item-avatar>
                                        <v-list-item-content @click="onclick()">
                                            <router-link :to="{ name: 'topic.show', params: { value: 'topic.id' } }">
                                                <v-list-item-title v-text="topic.name"></v-list-item-title>
                                            </router-link>
                                            <v-list-item-subtitle v-text="topic.detail"></v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-divider v-if="index < mp_f_topics.length - 1" :key="index"></v-divider>
                            </template>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
import { mapState } from 'vuex'
export default {
	data () {
		return {
            selected: [2],
            page: 1,
            pageCount: 5,
		}
    },
    computed: mapState([ 'mp_f_topics' ]),
    methods: {
        onclick() {
            
        }
    }
}
</script>

<style lang="scss" scoped>

</style>