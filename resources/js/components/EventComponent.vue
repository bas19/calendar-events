<template>
    <div>
       <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Add Event</div>
                <div class="card-body">
                    <form action="#" class="form">
                        <div class="form-group">
                            <label for="event">Event</label>
                            <input type="text" class="form-control" v-model="event_title" name="event" id="event" placeholder="Event name">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" v-model="start_date" class="form-control" name="start_date" id="start_date" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" v-model="end_date" class="form-control" name="end_date" id="end_date" placeholder="End Date">
                                </div>
                            </div>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" v-model="day_in_week.monday"  type="checkbox" value="" id="monday">
                            <label class="form-check-label" for="monday">
                                Monday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" v-model="day_in_week.tuesday"  type="checkbox" value="" id="tuesday">
                            <label class="form-check-label" for="tuesday">
                                Tuesday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" v-model="day_in_week.wednesday"  type="checkbox" value="" id="wednesday">
                            <label class="form-check-label" for="wednesday">
                                Wednesday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" v-model="day_in_week.thursday"  type="checkbox" value="" id="thursday">
                            <label class="form-check-label" for="thursday">
                                Thursday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" v-model="day_in_week.friday"  type="checkbox" value="" id="friday">
                            <label class="form-check-label" for="friday">
                                Friday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" v-model="day_in_week.saturday"  type="checkbox" value="" id="saturday">
                            <label class="form-check-label" for="saturday">
                                Saturday
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" v-model="day_in_week.sunday"  type="checkbox" value="" id="sunday">
                            <label class="form-check-label" for="sunday">
                                Sunday
                            </label>
                        </div>
                        <br>
                        <br>
                        <button type="button" @click="validateForm()" class="btn btn-primary">Save</button>
                    </form>
                </div>      
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ getCurrentMonthYear() }}</div>
                <div class="card-body">
                    <ul>
                        <li v-bind:class="{ active: hasEvent(day) }" v-for="(day, index) in month_days" :key="index">
                            {{ day.format('D') + ' ' + day.format('ddd') }} 
                            {{ (hasEvent(day)) ? '-   ' + event_title : '' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import EventService from '../services/event';

    var moment = require('moment');

    export default {
        created () {
            this.getMonthDays();
        },
        data () {
            return {
                month_days: [],
                event_days: [],
                event_title: '',
                start_date: '',
                end_date: '',
                day_in_week: {
                    monday: false,
                    tuesday: false,
                    wednesday: false,
                    thursday: false,
                    friday: false,
                    saturday: false,
                    sunday: false,
                }
            }
        },
        methods: {
            getCurrentMonthYear () {
                return moment().format('MMMM YYYY');
            },
            validateForm () {

                if (!this.event_title) {
                    this.$toastr.error('Title is empty.', 'Error');
                    return;
                }

                if (!this.start_date) {
                    this.$toastr.error('Start date is empty.', 'Error');
                    return;
                }

                if (!this.end_date) {
                    this.$toastr.error('End date is empty.', 'Error');
                    return;
                }
                
                let recurring = false;

                _.each(this.day_in_week, (day) => {
                    if (day) {
                        recurring = true;
                        return;
                    }
                });

                if (!recurring) {
                    this.$toastr.error('Please select recurring days.', 'Error');
                    return;
                }

                this.addEvent();
            },
            getMonthDays () {
                let month = moment().month();
                let daysInMonth = moment().month(month).daysInMonth();

                for (let i = 1; i <= daysInMonth; i++) {
                    this.month_days.push(moment().month(month).date(i));
                }
            },
            addEvent() {
                let self = this;
                let event = {
                    title: this.event_title,
                    start_date: this.start_date,
                    end_date: this.end_date,
                    monday: this.day_in_week.monday,
                    tuesday: this.day_in_week.tuesday,
                    wednesday: this.day_in_week.wednesday,
                    thursday: this.day_in_week.thursday,
                    friday: this.day_in_week.friday,
                    saturday: this.day_in_week.saturday,
                    sunday: this.day_in_week.sunday,
                }
                EventService.create(event)
                    .then((result) => {
                        if (result.data.success) {
                            var data = result.data.data;
                            self.event_title = data.title;
                            self.addEventDays(data.events);
                            this.$toastr.success('Event successfully saved.', 'Success');
                        } else {
                            this.$toastr.error('Something went wrong!', 'Server rrror')
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            addEventDays (events) {
                let self = this;
                if (events.length > 0) {
                    self.event_days = [];
                    events.forEach((event) => {
                        self.event_days.push(moment(event.start_date).format('YYYY-MM-DD'))
                    });
                }
            },
            hasEvent (day) {
                return _.find(this.event_days, function(o) { 
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
    background: #3a6990;
    color: #fff;
}
</style>