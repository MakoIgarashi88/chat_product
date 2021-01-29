<template>
	<div>
		<v-row justify="center">
			<v-col cols="10">
				<v-card>
					<v-row>
						<v-col class="text-center">
							<v-checkbox v-model="selected" label="red"></v-checkbox>
						</v-col>
						<v-col class="text-center">
							<v-checkbox v-model="selected" label="blue"></v-checkbox>
						</v-col>
						<v-col class="text-center">
							<v-checkbox v-model="selected" label="green"></v-checkbox>
						</v-col>
					</v-row>
					<v-row justify="center">
						<v-col class="text-center" v-for="(alpha, index) in alphas" :key="index">
							{{ alpha }}
							<v-checkbox :label="alpha" :value="index" v-model="checked"></v-checkbox>
						</v-col>
					</v-row>
					<v-row>
						<v-col>
							{{ selected }}
						</v-col>
						<v-col>
							{{ checked }}
						</v-col>
						<v-col>

						</v-col>
					</v-row>
				</v-card>
			</v-col>
		</v-row>
	</div>
</template>


<script>
	export default {
		data() {
			return {
				numbers: [1,2,3,4,5,6,7,8,9],
				alphas: ['a','b','c','d','e','f','g',],
				selected: [],
				checked: [],
			}
		},

		methods: {
		},
}
</script>