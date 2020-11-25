<template>
    <v-card outlined>
        <v-row justify="center">
            <v-col cols="12" md="8">
                <v-card outlined>
                    <v-card-title class="justify-center">
                        <div>(name){{board.name}}</div>
                    </v-card-title>
                    <v-card-text>
                        <div class="text-center">(detail){{board.detail}}</div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" md="8">
                <v-card outlined>
                    <v-list>
                        <template v-for="(item) in items">
                            <v-list-item :key="item.title">
                                <v-list-item-avatar>
                                    <img :src="item.avatar">
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title>{{item.title}}</v-list-item-title>
                                    <v-list-item-subtitle>{{item.subtitle}}</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </template>
                    </v-list>
                </v-card>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" md="8">
                <v-textarea solo label="メッセージを入力してください"></v-textarea>
            </v-col>
        </v-row>
        <v-row justify="center" class="pa-0">
            <v-col cols="auto" class="pa-0 pb-2">
                <v-btn>送信</v-btn>
            </v-col>
        </v-row>
    </v-card>
    
</template>

<script>
export default {
  data () {
    return {
        board: {
            name: 'こんにちは',
            detail: '自由に書き込んでください',
        },
        items: [
        { avatar: '/storage/images/AxjoQSN8CYhihwNc.png', title: 'かっちゃん', subtitle: 'くそナード' },
        { avatar: '/storage/images/yAyRulAQaz6f7DIV.png', title: 'しのぶ', subtitle: '仲良くするのは無理なようですね'},
        { avatar: '/storage/images/1z2M3ouOdb74r93Q.png', title: '忍', subtitle: 'ぱないのう' },
      ],
    }
  }
}
</script>

<style lang="scss" scoped>

</style>