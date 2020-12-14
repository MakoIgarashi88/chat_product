<template>
    <div>
        <!--自分-->
        <v-row align="center" justify="end" v-if="message.is_myself">
            <v-col cols="auto" class="pl-12">
                <div class="right">
                    <p>{{message.body}}</p>
                </div>
            </v-col>
        </v-row>

        <!--相手-->
        <v-row align="start" v-else>
            <v-col cols="auto" class="pt-4">
                <IconSm :src="message.image"/>
            </v-col>
            <v-col class="auto">
                <v-row>
                    <v-col cols="12" class="pa-1">
                        <router-link :to="{ name: 'friend.show', params: { 'user_id': message.user_id } }">
                            {{message.nickname}}
                        </router-link>
                    </v-col>
                    <div class="left">
                        <p>{{message.body}}</p>
                    </div>
                </v-row>
            </v-col>
        </v-row>



        <!-- <v-list-item align="center" justify="end" v-if="message.is_myself">
            <v-list-item-content>
                <v-list-item-subtitle>
                    {{message.body}}
                </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>


        <v-list-item v-else>
            <v-list-item-avatar>
                <IconSm :src="message.image"/>
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title>
                    <router-link :to="{ name: 'friend.show', params: { 'user_id': message.user_id } }">
                            {{message.nickname}}
                        </router-link>
                </v-list-item-title>
                <v-list-item-subtitle>
                    {{message.body}}
                </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item> -->


    </div>
</template>

<script>
export default {
    props: ['message'],
    data () {
        return {
            is_myself: false,
        }
    },
}
</script>

<style lang="scss" scoped>
// 自分
.right {
  position: relative;
  display: inline-block;
  margin: 0;
  padding: 7px 10px;
  min-width: 1rem;
  max-width: 100%;
  color: rgb(104, 103, 103);
  font-size: 16px;
  background: #fac9a1;
  border-radius: 15px;
}

.right p {
  margin: 0;
  padding: 0;
}

// 相手
.left {
  position: relative;
  display: inline-block;
  margin: 0;
  padding: 7px 10px;
  min-width: 1rem;
  max-width: 90%;
  color: rgb(104, 103, 103);
  font-size: 16px;
  background: #fde0aa;
  border-radius: 15px;
}

.left p {
  margin: 0;
  padding: 0;
}

</style>