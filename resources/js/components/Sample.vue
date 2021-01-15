<template>
	<div>
		<div>
	
			<v-card
				max-width="400"
				class="mx-auto"
			>
				<v-virtual-scroll
					:items="itemsss"
					height="300"
					item-height="64"
				>
					<template v-slot:default="{ item }">
						<v-list-item :key="item">
	
							<v-list-item-content>
								<v-list-item-title>
									<strong>{{ item }}</strong>
								</v-list-item-title>
							</v-list-item-content>
						</v-list-item>
	
						<v-divider></v-divider>
					</template>
				</v-virtual-scroll>
			</v-card>
		</div>

		<v-divider class="pa-5"></v-divider>

		<div>
			<v-card
			class="mx-auto"
			max-width="400"
			>
			<v-card-title class="white--text orange darken-4">
				User Directory
			</v-card-title>
		
			<v-virtual-scroll :items="items" :item-height="50" height="300">
				<template v-slot:default="{ item }">
				<v-list-item>
					<v-list-item-avatar>
					<v-avatar>
					<IconSm :src="image" />
					</v-avatar>
					</v-list-item-avatar>
		
					<v-list-item-content>
					<v-list-item-title>{{ item.fullName }}</v-list-item-title>
					</v-list-item-content>
		
				</v-list-item>
				</template>
			</v-virtual-scroll>
			</v-card>
		</div>
	</div>
</template>


<script>
  export default {
    data: () => ({
	  image: "/storage/images/06.png",
      colors: ['#2196F3', '#90CAF9', '#64B5F6', '#42A5F5', '#1E88E5', '#1976D2', '#1565C0', '#0D47A1', '#82B1FF', '#448AFF', '#2979FF', '#2962FF'],
      names: ['Oliver', 'Jake', 'Noah', 'James', 'Jack', 'Connor', 'Liam', 'John', 'Harry', 'Callum', 'Mason', 'Robert', 'Jacob', 'Jacob', 'Jacob', 'Michael', 'Charlie', 'Kyle', 'William', 'William', 'Thomas', 'Joe', 'Ethan', 'David', 'George', 'Reece', 'Michael', 'Richard', 'Oscar', 'Rhys', 'Alexander', 'Joseph', 'James', 'Charlie', 'James', 'Charles', 'William', 'Damian', 'Daniel', 'Thomas', 'Amelia', 'Margaret', 'Emma', 'Mary', 'Olivia', 'Samantha', 'Olivia', 'Patricia', 'Isla', 'Bethany'],
      surnames: ['Smith', 'Anderson', 'Clark', 'Wright', 'Mitchell', 'Johnson', 'Thomas', 'Rodriguez', 'Lopez', 'Perez', 'Williams', 'Jackson', 'Lewis', 'Hill', 'Roberts', 'Jones', 'White', 'Lee', 'Scott', 'Turner', 'Brown', 'Harris', 'Walker', 'Green', 'Phillips', 'Davis', 'Martin', 'Hall', 'Adams', 'Campbell', 'Miller', 'Thompson', 'Allen', 'Baker', 'Parker', 'Wilson', 'Garcia', 'Young', 'Gonzalez', 'Evans', 'Moore', 'Martinez', 'Hernandez', 'Nelson', 'Edwards', 'Taylor', 'Robinson', 'King', 'Carter', 'Collins'],
	//   items: [
	// 	  {
	// 		  color: '#2196F3',
	// 		  fullName:'Oliver',
	// 		  initials:'Smith',
	// 	  },
	//   ]
    }),

    computed: {
      items () {
        const namesLength = this.names.length
        const surnamesLength = this.surnames.length
        const colorsLength = this.colors.length

        return Array.from({ length: 10000 }, (k, v) => {
          const name = this.names[this.genRandomIndex(namesLength)]
          const surname = this.surnames[this.genRandomIndex(surnamesLength)]

          return {
            color: this.colors[this.genRandomIndex(colorsLength)],
            fullName: `${name} ${surname}`,
            initials: `${name[0]} ${surname[0]}`,
          }
        })
	  },
	  
	  itemsss () {
        return ['abc','d','ef','abc','d','ef','abc','d','ef','abc','d','ef','abc','d','ef','abc','d','ef']
      },
      length () {
        return 10
      },
    },

    methods: {
      genRandomIndex (length) {
        return Math.ceil(Math.random() * (length - 1))
      },
    },
  }
</script>