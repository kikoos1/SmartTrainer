import axios from 'axios'
import qs from 'qs'

    let mix = {
        methods: {
            ajaxCall(method, url, params = '') {
                if (!url || !method) {
                    console.log('Please read the instruction')
                    return 'Please read the instruction'
                }
                let config = {"method": method,
                    "url": url,
                    "maxRedirects": 2,
                }
                config['headers'] = {'Content-Type':'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization':'Bearer '+localStorage.access_token}
                if ((method == 'POST')) {
                    if (!params) {
                        console.log('POST without body')
                        return 'POST without body'
                    } else {
                        config["data"] = qs.stringify(params);
                        //config["headers"] = {'content-type': 'application/x-www-form-urlencoded'};

                    }
                }
                    if ((method == 'PATCH')) {
                        if (!params) {
                            console.log('POST without body')
                            return 'POST without body'
                        } else {
                            config["data"] = qs.stringify(params);
                            //config["headers"] = {'content-type': 'application/x-www-form-urlencoded'};

                        }

                    }
                    if ((method == 'GET')) {
                        if (params) {
                            config["params"] = params
                        }
                    }
                    if ((method == 'DELETE')) {
                        if (params) {
                            config["params"] = params
                        }
                    }

                return axios(config)
                    .then((response) => {
                        try {
                            if (response.data != ''){
                                JSON.parse(response.data)
                            }
                        } catch (error) {
                            if (typeof  response.data == "string") {
                                console.error('Result is not JSON. '+error.message+' response: '+response.data)
                            }
                        }
                        return new Promise((resolve, reject) => {
                            resolve(response.data)
                        })
                    })
                    .catch((err) => {
                        return new Promise((resolve, reject) => {
                            reject(err);
                        })
                    })
            },
            get(url) {
                return this.ajaxCall('GET', url)
            },
            post(url,params ){
                return this.ajaxCall('POST', url, params )
            },
            patch(url,params ){
                return this.ajaxCall('PATCH', url, params )
            },
            delete(url) {
                return this.ajaxCall('DELETE', url)
            },
            redirect(url){
                window.location.replace(url);
            },
            
            push_notification(img_url = '', body) {
                Notification.requestPermission( permission => {
                    let notification = new Notification(body, {
                        body: '', // content for the alert
                        icon: "https://pusher.com/static_logos/320x320.png" // optional image url
                    });

                    // link to page on clicking the notification
                    notification.onclick = () => {
                        window.open(window.location.href);
                    };
                });
            },
            Calculate_Calories(weight,height,age,activity,goal){
                var calories_and_macros = {
                    calories:0,
                    protein:0,
                    carbs:0,
                    fat:0
                };
                console.log(height);
                console.log(weight);
                console.log(age);
                
                var  bmr = ((height*6.25)+(weight*9.99)-(age*4.92)+5);
                
                
                var calories = (bmr*activity)+goal
               
                
                var protein =  Math.round(weight*2);
                var fat = Math.round(weight);
                var carbs = (calories-((protein*4)+(fat*9)));;
                
                console.log(calories);
                calories_and_macros.calories = Math.round(calories);
                calories_and_macros.protein = protein;
                calories_and_macros.fat =fat;
                calories_and_macros.carbs = Math.round(carbs/4);
                return calories_and_macros;
            }

        }
}

export default  mix;