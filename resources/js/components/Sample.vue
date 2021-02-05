<template>
	<div>
		<v-row justify="center">
			<v-col cols="10">
				<v-form ref="form">
					<v-card>
						<v-card-text>
							<h1>入力フォーム</h1>
						</v-card-text>
						<v-card-text>
							<v-text-field
							label="名前"
							v-model="name"
							:rules="nameRules"
							outlined 
							></v-text-field>
							<v-form ref="form2">
								<v-row align="center">
									<v-col>
										<v-text-field
										:disabled="tags.length >= 3"
										:label="tags.length >= 3 ? 'タグの設定は３件までです' :'タグ'"
										:rules="[ v => (v && v.length <= 30) || '30文字以内で入力してください' ]"
										v-model="tag" 
										outlined 
										@keyup.enter="onAddTag"
										/>
									</v-col>
									<v-col cols="auto">
										<v-btn @click="onAddTag" color="primary">追加</v-btn>
									</v-col>
								</v-row>
							</v-form>
								<v-row>
									<v-col>
										<v-card outlined>
											<v-row>
												<v-col>
													<v-chip-group>
														<v-chip
														v-for="(tag,index) in tags" :key="index"
														@click:close="onRemove(index)"
														close
														class="ml-2"
														small
														color="tag" 
														text-color="white" 
														>
															{{tag}}
														</v-chip>
													</v-chip-group>
												</v-col>
											</v-row>
										</v-card>
									</v-col>
								</v-row>
							

						</v-card-text>
						<v-card-text>
							<v-btn color="primary" @click="submit">送信</v-btn>
						</v-card-text>
					</v-card>
					<v-card v-show="answer">
						<v-row justify="center">
							<v-col class="text-center">
								<h3>{{ answer }}</h3>
							</v-col>
						</v-row>
					</v-card>
				</v-form>
			</v-col>
		</v-row>
	</div>
</template>


<script>
	export default {
		data() {
			return {
				name: "",
				answer: "",
				tag: "",
				tags: [],
				nameRules: [
					v => !!v || "入力してください",
					v => (!!v && v.length <= 20 || ("20文字以内で入力してください"))
				],
			}
		},

		methods: {
			submit() {
				if (!this.$refs.form.validate()) return
				this.answer = this.name
				this.name = ""
			},
			onAddTag () {
				if (!this.$refs.form2.validate()) return
				if ( this.tag ) {
					this.tags.push(this.tag)
					this.tag = ""
				}
			}
		},
}
</script>