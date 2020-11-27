<template>
    <v-container>
        <v-row align="center">
            <v-col cols="auto" class="text-right">
                <v-avatar>
                    <img :src="image">
                </v-avatar>
            </v-col>
            <v-col cols="auto">
                <div class="right">
                    <p>自分。こんにちわんわん</p>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col class="text-center">
                <div class="left">
                    <p>相手だよ～～～～～～～～～～～～～んおなかいたーい</p>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data () {
        return {
            image: '/storage/images/yAyRulAQaz6f7DIV.png',
        }
    }
}
</script>

<style lang="scss" scoped>
// 自分
.right {
  position: relative;
  display: inline-block;
  margin: 0;
  padding: 7px 10px;
  min-width: 120px;
  max-width: 100%;
  color: rgb(104, 103, 103);
  font-size: 16px;
  background: #fdcfaa;
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
  min-width: 120px;
  max-width: 100%;
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