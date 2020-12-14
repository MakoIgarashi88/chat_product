<template>
    <div>
        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary">
                    <i class="fas fa-cog"></i>
                </v-btn>
            </template>

            <v-card>
                <v-card-title>
                    <v-row justify="center">
                        <v-col class="text-center">
                            {{name}}編集
                        </v-col>
                    </v-row>
                </v-card-title>
               <v-card-text>
                    <v-row justify="center">
                        <v-col>
                            <v-text-field
                             label="タイトル"
                             outlined
                             rows="1"
                             row-height="15"
                             hide-details
                             v-model="board.name"
                             ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-textarea
                             label="詳細" 
                             outlined rows="2" 
                             row-height="15" 
                             hide-details
                             v-model="board.detail"
                             ></v-textarea>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="text-center">
                            <v-btn color="primary" @click="onEdit()">編集</v-btn>
                        </v-col>
                    </v-row>
               </v-card-text>

            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    props: ['name'],
    data () {
        return {
            dialog: false,
            board: {
                name: "",
                detail: "",
            }
        }
    },
    methods: {
        onEdit() {
                this.dialog = false
                this.$emit('update', this.board)
        },
    },
}
</script>