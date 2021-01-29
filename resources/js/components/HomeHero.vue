
<template>
  <section class="home-hero">
    <v-container fluid fill-height class="home-hero__content">
      <v-row>
        <v-col class="home-hero__content-text">
          <p>面白そうなトピックを見つけて、意見を発信しよう！<br>
                気が合う人を見つけて友達を作り、Pooseライフを楽しみましょう！</p>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>
<style  lang="scss" scoped>
.home-hero__content {
    background: url("/storage/images/happy.jpg");
    background-size: cover;
    background-position: center center;
    width: 100%;
    height: 50vh;
 
  &-text {
    color: rgb(0, 0, 0);
    text-align: center;
    align-items: flex-end;
    font-size: 28px;
    font-weight: bold;
    // text-shadow    : 
    //     2px  2px 1px #000000,
    //     -2px  2px 1px #000000,
    //     2px -2px 1px #000000,
    //     -2px -2px 1px #000000,
    //     2px  0px 1px #000000,
    //     0px  2px 1px #000000,
    //     -2px  0px 1px #000000,
    //     0px -2px 1px #000000;   
    }
}
</style>