<template>
    <v-card>
        <v-row justify="center">
            <v-col cols="11">
                <v-card outlined>
                    <v-list two-line>
                        <v-list-item-group v-model="selected" active-class="pink--text">
                            <template v-for="(item, index) in items">
                                <v-list-item :key="item.title">
                                    <template>
                                        <v-list-item-avatar>
                                          	<IconSm :src="item.image" />
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title v-text="item.title"></v-list-item-title>
                                            <v-list-item-subtitle v-text="item.subtitle"></v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-list-item-action>
                                            <v-list-item-action-text v-text="item.action"></v-list-item-action-text>
                                        </v-list-item-action>
                                    </template>
                                </v-list-item>
                                <v-divider v-if="index < items.length - 1" :key="index"></v-divider>
                            </template>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
export default {
  data () {
    return {
      selected: [2],
      items: [
        {
          action: '15 min',
          title: 'しのぶさん好きな人たち',
          subtitle: '本誌派多数',
          image: null,
        },
        {
          action: '15 min',
          title: '呪術廻戦',
          subtitle: '呪術メイン、他の話もオッケー',
          image: '/storage/images/Z4Wm6pZfqcoD6Hu1.png',
        },
        {
          action: '15 min',
          title: '韓国人になる',
          subtitle: '反韓は立ち去れ',
          image: '/storage/images/QPZUNpPqoz4RPHY2.png',
        },
      ],
    }
  }
}
</script>

<style lang="scss" scoped>

</style>