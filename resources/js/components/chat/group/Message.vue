<template>
    <div>
        <!--自分-->
        <v-row align="center" justify="end" v-if="is_myself">
            <v-col cols="auto">
                <div class="right">
                    <p>自分。こんにちわんわん</p>
                </div>
            </v-col>
        </v-row>

        <!--相手-->
        <v-row align="center" v-else>
            <v-col cols="auto">
                <IconSm :src="image"/>
            </v-col>
            <v-col class="auto">
                <div class="left">
                    <p>相手だよ～～～～～～～～～～～～～んおなかいたーい</p>
                </div>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    props: [''],
    data () {
        return {
            image: '/storage/images/1z2M3ouOdb74r93Q.png',
            is_myself: false,
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