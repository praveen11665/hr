/**
*  - Responsive Bootstrap 4 Admin Dashboard
* 
* Form wizard page
*/

!function(t){"use strict";var i=function(){};i.prototype.createBasic=function(i){return i.children("div").steps({headerTag:"h3",bodyTag:"section",transitionEffect:"slideLeft",onFinishing:function(t,i){return console.log("Form has been validated!"),!0},onFinished:function(i,e){console.log("Form can be submitted using submit method. E.g. $('#basic-form').submit()"),t("#basic-form").submit()}}),i},i.prototype.createVertical=function(t){return t.steps({headerTag:"h3",bodyTag:"section",transitionEffect:"fade",stepsOrientation:"vertical"}),t},i.prototype.init=function(){this.createBasic(t("#basic-form")),this.createVertical(t("#wizard-vertical"))},t.FormWizard=new i,t.FormWizard.Constructor=i}(window.jQuery),function(t){"use strict";t.FormWizard.init()}(window.jQuery);