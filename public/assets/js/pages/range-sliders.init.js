$(document).ready(function(){$("#range_01").ionRangeSlider({skin:"modern"}),$("#range_02").ionRangeSlider({skin:"modern",min:100,max:1e3,from:550}),$("#range_03").ionRangeSlider({skin:"modern",type:"double",grid:!0,min:0,max:1e3,from:200,to:800,prefix:"$"}),$("#range_04").ionRangeSlider({skin:"modern",type:"double",grid:!0,min:-1e3,max:1e3,from:-500,to:500}),$("#range_05").ionRangeSlider({skin:"modern",type:"double",grid:!0,min:-1e3,max:1e3,from:-500,to:500,step:250}),$("#range_06").ionRangeSlider({skin:"modern",grid:!0,from:3,values:["فروردین","اردیبهشت","تیر","خرداد","مرداد","شهریور","مهر","آبان","آذر","دی","بهمن","اسفند"]}),$("#range_07").ionRangeSlider({skin:"modern",grid:!0,min:1e3,max:1e6,from:2e5,step:1e3,prettify_enabled:!0}),$("#range_08").ionRangeSlider({skin:"modern",min:100,max:1e3,from:550,disable:!0}),$("#range_09").ionRangeSlider({skin:"modern",grid:!0,min:18,max:70,from:30,prefix:"سن ",max_postfix:"+"}),$("#range_10").ionRangeSlider({skin:"modern",type:"double",min:100,max:200,from:145,to:155,prefix:"وزن: ",postfix:" تن",decorate_both:!0}),$("#range_11").ionRangeSlider({skin:"modern",type:"single",grid:!0,min:-90,max:90,from:0,postfix:" درجه"}),$("#range_12").ionRangeSlider({skin:"modern",type:"double",min:1e3,max:2e3,from:1200,to:1800,hide_min_max:!0,hide_from_to:!0,grid:!0})});