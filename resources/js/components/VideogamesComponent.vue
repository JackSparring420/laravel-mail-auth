<template>
    <div id="videogames">
        <h1>Videogames</h1>
        <table border="2">
            <tr>
                <th>title</th>
                <th>subtitle</th>
                <th>release_date</th>
                <th>PEGI</th>
                <th v-if="user">Action</th>
                
            </tr>

            <tr v-for="videogame in videogames" :key="videogame.id ">
                <td>{{videogame.title}}</td>
                <td>{{videogame.subtitle}}</td>
                <td>{{videogame.release_date}}</td>
                <td>{{videogame.pegi}}</td>
                <td v-if="user"> 
                    <!-- <a :href="'/api/videogames/delete/' +  videogame.id" class="btn btn-danger">DELETE</a> -->
                    <button @click="eventDelete(videogame.id)" class="btn btn-danger">DELETE</button>
                </td>

            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                videogames: []
            };
        },
        props: {

            user: String
        },
        methods: {

            eventDelete(id) {

                const self = this;
                axios.get(`/api/videogame/delete/${id}`)
                .then(r => {
                    const ind = self.getIndexById(id);
                    self.videogames.splice(ind, 1)
                })
                .catch(e => console.error(e));

            },

            getIndexById(id) {
                for (let x=0; x<this.videogames.length; x++) {
                    const videogame = this.videogames[x];

                    if (videogame.id == id)
                    return x;
                }

                return -1;
            }
        },
        mounted() {

            console.log(this.user);
            
            axios.get('/api/videogames/list')
            .then(r => this.videogames = r.data)
            .catch(e => console.error(e));
        }
    }
</script>
