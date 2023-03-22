<template>
  <main>
    <div class="sidebar">
      <div v-if="user?.id">
        <section class="sidebar-profile">
          <img :src="'src/assets/avatars/' + user.avatar">
          <div>
            <h3>{{ user.name }}</h3>
            <p>working {{ user.created_at }}</p>
            <button @click="endSession()">End session</button>
          </div>
        </section>
        
        <section class="sidebar-zones">
          <div v-for="(zone, index) in zones" :key="index">
            <h4 @click="changeZone(zone.id)">{{ zone.name }} ({{ zone.current_users.length }}/{{ zone.users_count }})</h4>
            <div>
              <p
                  v-for="(zone_user, index) in zone.current_users"
                 :key="index"
              >{{ zone_user.name }}</p>
            </div>
          </div>
        </section>

        <section class="sidebar-chat">
          <strong>The office chat</strong>
          <div class="sidebar-chat-box" ref="chat_box">
            <div v-for="(message, index) in messages" :key="index">
              <strong>{{ message.user.name }}:</strong> {{ message.message }}
            </div>
          </div>
          <div @submit.prevent>
            <input type="text" name="message" placeholder="Message..." v-model="chat.message">
            <button @click="sendMessage">Send</button>
          </div>
        </section>
      </div>

      <div v-else>
        <section class="sidebar-start-session">
          <h2>Start session</h2>
          <form @submit.prevent="startSession">
            <label>Your name:
              <input name="name" type="text" placeholder="Type your name..." v-model="session_form.name">
            </label>
            <label>Avatar:
              <div class="sidebar-start-session-avatars">
                <img src="@/assets/avatars/avatar-01.svg" @click="session_form.avatar = 'avatar-01.svg'" :style="{transform: 'avatar-01.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-02.svg" @click="session_form.avatar = 'avatar-02.svg'" :style="{transform: 'avatar-02.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-03.svg" @click="session_form.avatar = 'avatar-03.svg'" :style="{transform: 'avatar-03.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-04.svg" @click="session_form.avatar = 'avatar-04.svg'" :style="{transform: 'avatar-04.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-05.svg" @click="session_form.avatar = 'avatar-05.svg'" :style="{transform: 'avatar-05.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-06.svg" @click="session_form.avatar = 'avatar-06.svg'" :style="{transform: 'avatar-06.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-07.svg" @click="session_form.avatar = 'avatar-07.svg'" :style="{transform: 'avatar-07.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-08.svg" @click="session_form.avatar = 'avatar-08.svg'" :style="{transform: 'avatar-08.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-09.svg" @click="session_form.avatar = 'avatar-09.svg'" :style="{transform: 'avatar-09.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-10.svg" @click="session_form.avatar = 'avatar-10.svg'" :style="{transform: 'avatar-10.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-11.svg" @click="session_form.avatar = 'avatar-11.svg'" :style="{transform: 'avatar-11.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-12.svg" @click="session_form.avatar = 'avatar-12.svg'" :style="{transform: 'avatar-12.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-13.svg" @click="session_form.avatar = 'avatar-13.svg'" :style="{transform: 'avatar-13.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-14.svg" @click="session_form.avatar = 'avatar-14.svg'" :style="{transform: 'avatar-14.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-15.svg" @click="session_form.avatar = 'avatar-15.svg'" :style="{transform: 'avatar-15.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-16.svg" @click="session_form.avatar = 'avatar-16.svg'" :style="{transform: 'avatar-16.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-17.svg" @click="session_form.avatar = 'avatar-17.svg'" :style="{transform: 'avatar-17.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-18.svg" @click="session_form.avatar = 'avatar-18.svg'" :style="{transform: 'avatar-18.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
                <img src="@/assets/avatars/avatar-19.svg" @click="session_form.avatar = 'avatar-19.svg'" :style="{transform: 'avatar-19.svg' === session_form.avatar ? 'scale(1.2)' : 'scale(1)' }" >
              </div>
            </label>
            <button>Create session</button>
          </form>
        </section>
      </div>

    </div>
    <div class="office">
      <div
          class="zone"
          v-for="(zone, index) in zones"
          :key="index"
          @dragover="dragOver"
          @drop="drop"
          @dragleave="dragLeave"
          :id="zone.id"
          :style="{width: zone.width + 'px', height: zone.height + 'px', top: zone.y + 'px', left: zone.x + 'px', backgroundColor: zone.color}"
      >
        {{ zone.name }}
      </div>
      <div
          v-if="users.length > 0"
          class="draggable"
          v-for="(user, index) in users"
          :key="index"
          :style="{top: user.y + 'px', left: user.x + 'px'}"
      >
        <img :src="'src/assets/avatars/' + user.avatar">
        <p>{{ user.name }}</p>
      </div>
      <div
          v-if="user?.id"
          draggable="true"
          @dragstart="drag"
          class="draggable"
          id="user"
          ref="user"
          :style="{top: user.y + 'px', left: user.x + 'px'}"
      >
        <img :src="'src/assets/avatars/' + user.avatar">
        <p>{{ user.name }}</p>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data () {
    return {
      zones: [],
      session_form: {
        avatar: null,
        name: null
      },
      chat: {
        message: null
      },
      user: null,
      users: [],
      messages: [],
      last_channel: 0
    }
  },
  created () {
    window.Echo.channel('user.move').listen('UserMoveEvent',(e)=>{
      this.axios.get('/users').then((response) => {
        this.users = response.data.data
      })
    })
  },
  mounted () {

    this.axios.get('/zones').then((response) => {
      this.zones = response.data.data
    })

    this.axios.get('/users').then((response) => {
      this.users = response.data.data
    })
    this.getUser()
  },
  methods: {
    async getMessages () {
      await this.axios.get('/messages').then((response) => {
        this.messages = response.data.data
        this.$refs.chat_box.scrollTop = this.$refs.chat_box.scrollHeight
      })
    },
    async sendMessage () {
      const form = {
        user_id: this.user.id,
        zone_id: this.user.zone_id,
        message: this.chat.message
      }

      await this.axios.post('/messages', form).then(async (response) => {
        this.chat.message = null
        console.log(response)
      })
    },
    listenChannel() {
      window.Echo.leave('zone.' + this.last_channel )
      window.Echo.private('zone.' + this.user.zone_id ).listen('MessageEvent',(e)=>{
        this.axios.get('/messages').then(async (response) => {
          this.messages = response.data.data
          this.$refs.chat_box.scrollTop = this.$refs.chat_box.scrollHeight
        })
      })
    },
    async startSession () {
      await this.axios.post('/users', this.session_form).then((response) => {
        console.log(response.data.access_token)
        window.localStorage.clear()
        localStorage.setItem('token',  response.data.access_token)
        this.user = response.data.data
        this.$forceUpdate()
      })
    },
    drag (event) {
      event.dataTransfer.setData('clientId', event.target.id)
    },
    dragOver (event) {
      event.target.style.transform = 'scale(1.1)'
      event.preventDefault()
    },
    dragLeave (event) {
      event.target.style.transform = 'scale(1)'
    },
    async drop (event) {
      event.target.style.transform = 'scale(1)'
      const id = event.dataTransfer.getData('clientId')
      const element = document.getElementById(id)
      element.style.top = event.clientY - 10 + 'px'
      element.style.left = event.clientX - 600 + 'px'
      this.user.zone_id = event.target.id
      this.user.x = event.clientX - 600
      this.user.y = event.clientY - 10
      this.axios.put('/users/' + this.user.id, this.user).then((response) => {
        this.getUser()
        this.getZones()
        this.getMessages()
      })
    },
    async getUser () {
      this.$forceUpdate()
      await this.axios.get('/me').then((response) => {
        this.user = response.data.data
        this.last_channel = response.data.data.zone_id
        this.listenChannel()
        this.getMessages()
      }).catch((e) => {
        this.user = null
      })
    },
    getZones () {
      this.axios.get('/zones').then((response) => {
        this.zones = response.data.data
        this.axios.get('/messages' ).then((response) => {
          this.messages = response.data.data
          this.chat.message = null
          this.$refs.chat_box.scrollTop = this.$refs.chat_box.scrollHeight
          this.listenChannel()
        })
      })
    },
    async changeZone (zone_id) {
      this.user.zone_id = zone_id
      console.log(zone_id)
      await this.axios.put('/users/' + this.user.id, this.user).then((response) => {
        this.getUser()
        this.getZones()
      })
    },
    async endSession () {
      await this.axios.get('/end_session').then((response) => {
        this.getUser()
        this.$forceUpdate()
      })
    }
  }
}
</script>

<style scoped>
main {
  display: flex;
  align-content: stretch;
  max-width: 1280px;
  justify-content: center;
  margin-left: auto;
  margin-right: auto;
  gap: 20px;
}

p, h4, h3 {
  padding: 0;
  margin: 0;
}

/*Sidebar */

.sidebar {
  width: 20%;
}

.sidebar div section {
  background-color: #e7e7e7;
}

.sidebar > div {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.sidebar-profile {
  display: flex;
  align-items: center;
  gap: 10px;
}

.sidebar-profile img {
  width: 75px;
  height: 75px;
  border-radius: 50%;
}

/*sidebar zones*/
.sidebar-zones {
  display: flex;
  flex-direction: column;
  gap: 25px;
  padding: 20px;
}

.sidebar-zones > div > h4 {
  cursor: pointer;
}

.sidebar-zones > div > div > p {
  margin-left: 20px;
}

/*sidebar chat */

.sidebar-chat {
  padding: 10px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.sidebar-chat-box {
  background-color: white;
  height: 170px;
  display: flex;
  flex-direction: column;
  gap: 5px;
  overflow: auto;
  scroll-behavior: smooth;
}

.sidebar-chat div {
  display: flex;
}

.sidebar-chat div input {
  padding: 5px;
  font-size: 12px;
  width: 100%;
}

/*start session */

.sidebar-start-session {
  padding: 10px;
}

.sidebar-start-session form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.sidebar-start-session-avatars  {
  display: flex;
  width: 100%;
  flex-direction: row !important;
  flex-wrap: wrap;
  justify-content: center;
  cursor: pointer;
}

.sidebar-start-session-avatars img {
  width: 75px;
  height: 75px;
  border-radius: 50%;
}

/* Office layout */
.office {
  background-repeat: no-repeat;
  position: relative;
  width: 80%;
  height: 720px;
  background-size: 100% 600px;
  background-image: url("../assets/office/office_base_clean.png");
}

.zone {
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  font-size: 12px;
}

.draggable {
  width: 50px;
  height: 50px;
  text-align: center;
  font-size: 12px;
  cursor: pointer;
  position: absolute;
}

.draggable img {
  width:30px;
  height: 30px;
  user-select: none;
  pointer-events: none;
  background: transparent;
}
</style>
