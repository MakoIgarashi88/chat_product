<template>
    <v-card outlined>
        <v-list>
            <template v-for="(item) in items">
                <v-list-item :key="item.title">
                    <v-list-item-avatar>
                        <IconSm :src="item.avatar" />
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{item.title}}</v-list-item-title>
                        <v-list-item-subtitle>{{item.subtitle}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </template>
        </v-list>
    </v-card>
</template>

<script>
export default {
    data () {
        return {
            items: [
                { avatar: '/storage/images/AxjoQSN8CYhihwNc.png', title: 'かっちゃん', subtitle: 'くそナード' },
                { avatar: '', title: 'しのぶ', subtitle: '仲良くするのは無理なようですね'},
                { avatar: '/storage/images/1z2M3ouOdb74r93Q.png', title: '忍', subtitle: 'ぱないのう' },
            ],
        }
    }
}
</script>