<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to='{name: "home"}'>Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to='{name: "airline"}'>Airline</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to='{name: "airport"}'>Aiports</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to='{name: "flight"}'>Flights</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
