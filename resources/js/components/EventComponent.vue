<template>
    <div>
       <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Add Event</div>
                <div class="card-body">
                    <form class="form">
                        <div class="form-group">
                            <label for="event">Event</label>
                            <input type="text" class="form-control" name="event" v-model="eventTitle" id="event" placeholder="Event name">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" placeholder="End Date">
                                </div>
                            </div>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="monday">
                            <label class="form-check-label" for="monday">
                                Monday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="tuesday">
                            <label class="form-check-label" for="tuesday">
                                Tuesday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="wednesday">
                            <label class="form-check-label" for="wednesday">
                                Wednesday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="thursday">
                            <label class="form-check-label" for="thursday">
                                Thursday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="friday">
                            <label class="form-check-label" for="friday">
                                Friday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="saturday">
                            <label class="form-check-label" for="saturday">
                                Saturday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="sunday">
                            <label class="form-check-label" for="sunday">
                                Sunday
                            </label>
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>      
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ getCurrentMonthYear() }}</div>
                <div class="card-body">
                    <ul>
                        <li v-bind:class="{ active: hasEvent(day) }" v-for="(day, index) in monthDays" :key="index">
                            {{ day.format('D') + ' ' + day.format('ddd') }} 
                            {{ (hasEvent(day)) ? '-   ' + eventTitle : '' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    var moment = require('moment');

    export default {
        created () {
            let month = moment().month();
            let daysInMonth = moment().month(month).daysInMonth();

            for (let i = 1; i <= daysInMonth; i++) {
                this.monthDays.push(moment().month(month).date(i));
            }
            this.getAllEvents(1);
        },
        data () {
            return {
                monthDays: [],
                eventDays: [],
                eventTitle: '',
            }
        },
        methods: {
            getCurrentMonthYear () {
                return moment().format('MMMM YYYY');
            },
            getAllEvents (id) {
                let self = this;
                axios.get('/api/events/' + id)
                    .then((data) => {
                        let events = data.data.events;
                        self.eventTitle = data.data.title;
                        self.eventDays.push(moment(data.data.start_date).format('YYYY-MM-DD'))
                        events.forEach((event) => {
                             self.eventDays.push(moment(event.start_date).format('YYYY-MM-DD'))
                        });
                    });
                console.log(this.eventDays);
                console.log(this.eventTitle);
            },
            hasEvent (day) {
                // let result = _.isMatch(this.eventDays, day.format('YYYY-MM-DD') );
                // console.log('reult', result);
                return _.find(this.eventDays, function(o) { 
                    return o == day.format('YYYY-MM-DD'); 
                });
            }
        }
    }
</script>

<style scoped>
ul {
    list-style: none;
    padding: 0;
}
ul li {
    padding: 8px;
    border-bottom: 1px solid #ddd;
}
ul li.active {
    background: #227dc7;
    color: #fff;
}
</style>