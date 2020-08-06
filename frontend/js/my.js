const apiURL = 'http://127.0.0.1:8001/api';
const tariffURL = apiURL + '/tariff';
const orderURL = apiURL + '/order';


async function loadTariffs() {
    const resp = await axios.get(tariffURL);
    this.tariffs = resp.data;
}

Date.prototype.addDays = function (days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

function selectTariff(tariff) {
    this.showSuccessMsg = false;
    this.selectedTariff = tariff;
    this.disabledDates.customPredictor = getDisableWeekdaysFunc(tariff.delivery_days);
    this.form.order.date = null;
}

function getDisableWeekdaysFunc(weekdays) {
    return (date) => {
        let d = date.getDay();
        if (d === 0) { d = 7 }
        return !weekdays.includes(d);
    }
}

function getWeekdayName(id) {
    const map = {
        1: 'Понедельник',
        2: 'Вторник',
        3: 'Среда',
        4: 'Четверг',
        5: 'Пятница',
        6: 'Суббота',
        7: 'Воскресенье',
    }

    if (map[id]) {
        return map[id];
    }
    return '';
}

async function submitPressed() {
    this.showSuccessMsg = false;
    let isFail = false;
    if (!this.form.client.phone) {
        this.isInvalid.phone = true;
        isFail = true
    }
    if (!this.form.client.name) {
        this.isInvalid.name = true;
        isFail = true
    }
    if (!this.form.order.address.street) {
        this.isInvalid.address = true;
        isFail = true
    }
    if (!this.form.order.date) {
        this.isInvalid.date = true;
        isFail = true
    }
    if (isFail) return;

    let postData = Object.assign({}, this.form);
    postData.order.tariff_id = this.selectedTariff.id;

    this.isSubmitting = true;
    self = this;
    await axios.post(orderURL, postData)
        .then(function (resp) {
            self.isSubmitting = false;
            self.showSuccessMsg = true;
        }).catch(function (error) {
            self.isSubmitting = false;
            if (error?.response?.data?.errors) {
                const invalidFields = Object.keys(error.response.data.errors).map((field) => field.split('.')[1]);
                invalidFields.forEach((field) => {
                    if (self.isInvalid.hasOwnProperty(field)) {
                        self.isInvalid[field] = true;
                    }
                });
            }
    });
}

new Vue({
    el: '#vue_root',
    data: {
        disabledDates: {
            to: new Date(),
            from: (new Date()).addDays(90),
            customPredictor: () => { }
        },
        tariffs: [],
        selectedTariff: null,
        form: {
            client: {
                phone: '+7',
                name: '',
            },
            order: {
                date: '',
                address: {
                    street: '',
                    building: '',
                    apt: '',
                }
            }
        },
        isInvalid: {
            phone: false,
            name: false,
            address: false,
            date: false,
        },
        isSubmitting: false,
        showSuccessMsg: false
    },
    components: {
        vuejsDatepicker
    },
    created: loadTariffs,
    methods: {
        selectTariff: selectTariff,
        getWeekdayName: getWeekdayName,
        submit: submitPressed,
    }
})