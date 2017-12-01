<template>
	<div class="table-responsive">
		<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Chat ID</th>
				<th>Token</th>
				<th></th>
			</tr>
		</thead>
		<tr v-for="user in users">
			<td width="100">
					{{ user.name }}
			</td>
			<td width="100">
					{{ user.email }}
			</td>
			<td width="100">
					{{ user.phone }}
			</td>
			<td width="200px">
				<template v-if="editing.id === user.id">
					<input class="form-control" :class="{ 'error' : editing.errors.chat_id }" v-model="editing.form.chat_id">
					<span class="help-block" v-if="editing.errors.chat_id">
						<strong>{{ editing.errors.chat_id[0] }}</strong>
					</span>
				</template>
				<template v-else>
					{{ user.chat_id }}
				</template>
			</td>
			<td width="300px">
				<template v-if="editing.id === user.id">
					<input class="form-control" :class="{ 'error' : editing.errors.token }" v-model="editing.form.token">
					<span class="help-block" v-if="editing.errors.token">
						<strong>{{ editing.errors.token[0] }}</strong>
					</span>
				</template>
				<template v-else>
					<code>{{ user.token }}</code>
				</template>

			</td>
			<td>
				<template v-if="editing.id !== user.id">
					<a href="#" @click.prevent="edit(user)">
						edit
					</a>
				</template>
				<template v-else>
					<a href="#" class="text-danger" @click.prevent="update()">
						save
					</a>
					<a href="#" @click.prevent="editing.id = null; editing.form = {}">
						cancel
					</a>
				</template>

			</td>
		</tr>
	</table>
	</div>
</template>
<script>
	export default{

		data(){
			return {
				users : [],
				editing : {
					id : null,
					form : {},
					errors : []
				},
				response : []
			}
		},
		mounted(){
			this.getUsers();
		},
		methods :{
			getUsers(){
				return axios.get('/users').then(
					(response)=>{
						this.users = response.data;
					}
				);
			},
			edit(user){
				this.editing.errors = [];
				this.editing.id = user.id
				this.editing.form = _.pick(user,['chat_id','token']);
			},
			update(){
				axios.patch(`/users/${this.editing.id}`, this.editing.form).then(
					()=>{
						this.getUsers().then(
							()=>{
								this.editing.id = null;
								this.editing.form = {};
								this.editing.errors = [];
							});
					}).catch(
						(error)=>{
							console.log(error.response.data);
							this.editing.errors = error.response.data.errors;
						}
					);
			}
		}
	}
</script>
