this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.action=this.WP_Optimize_Handlebars.action||{},this.WP_Optimize_Handlebars.action.handlebars=Handlebars.template({1:function(l,e,n,a,t){return'    <span class="wpo_edit_event"><span class="dashicons dashicons-edit"></span></span>\n'},compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s,u=null!=e?e:l.nullContext||{},o=l.escapeExpression;return'<div class="wpo_event_actions">\n'+(null!=(i=n["if"].call(u,null!=e?e.stored:e,{name:"if",hash:{},fn:l.program(1,t,0),inverse:l.noop,data:t,loc:{start:{line:2,column:4},end:{line:4,column:11}}}))?i:"")+'    <span class="wpo_remove_event" data-count="'+o((s=null!=(s=n.count||(null!=e?e.count:e))?s:l.hooks.helperMissing,"function"==typeof s?s.call(u,{name:"count",hash:{},data:t,loc:{start:{line:5,column:47},end:{line:5,column:56}}}):s))+'"><span class="dashicons dashicons-no-alt" title="'+o(l.lambda(null!=(i=null!=e?e.wpoptimize:e)?i.remove_task:i,e))+'"></span></span>\n</div>\n'},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.daily=this.WP_Optimize_Handlebars.daily||{},this.WP_Optimize_Handlebars.daily.handlebars=Handlebars.template({compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s=l.lambda,u=l.escapeExpression;return"<label>"+u(s(null!=(i=null!=e?e.details:e)?i.time:i,e))+'\n<input type="time" class="'+u(s(null!=(i=null!=e?e.details:e)?i.class_name:i,e))+'" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][time]" value="'+u(s(null!=(i=null!=e?e.details:e)?i.time_value:i,e))+'">\n</label>'},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.fortnightly=this.WP_Optimize_Handlebars.fortnightly||{},this.WP_Optimize_Handlebars.fortnightly.handlebars=Handlebars.template({1:function(l,e,n,a,t){var i,s=l.escapeExpression;return'    <option value="'+s((i=null!=(i=n.key||t&&t.key)?i:l.hooks.helperMissing,"function"==typeof i?i.call(null!=e?e:l.nullContext||{},{name:"key",hash:{},data:t,loc:{start:{line:6,column:19},end:{line:6,column:27}}}):i))+'">'+s(l.lambda(e,e))+"</option>\n"},compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s=l.lambda,u=l.escapeExpression,o=null!=e?e:l.nullContext||{};return"<label>"+u(s(null!=(i=null!=e?e.details:e)?i.time:i,e))+'\n<input type="time" class="'+u(s(null!=(i=null!=e?e.details:e)?i.class_name:i,e))+'" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][time]" value="'+u(s(null!=(i=null!=e?e.details:e)?i.time_value:i,e))+'">\n</label>\n<select class="wpo_week_number" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][week]">\n'+(null!=(i=n.each.call(o,null!=(i=null!=e?e.details:e)?i.week:i,{name:"each",hash:{},fn:l.program(1,t,0),inverse:l.noop,data:t,loc:{start:{line:5,column:4},end:{line:7,column:13}}}))?i:"")+'</select>\n<select class="wpo_week_days" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][day]">\n'+(null!=(i=n.each.call(o,null!=(i=null!=e?e.details:e)?i.week_days:i,{name:"each",hash:{},fn:l.program(1,t,0),inverse:l.noop,data:t,loc:{start:{line:10,column:4},end:{line:12,column:13}}}))?i:"")+"</select>"},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.monthly=this.WP_Optimize_Handlebars.monthly||{},this.WP_Optimize_Handlebars.monthly.handlebars=Handlebars.template({1:function(l,e,n,a,t){var i,s=l.escapeExpression;return'    <option value="'+s((i=null!=(i=n.key||t&&t.key)?i:l.hooks.helperMissing,"function"==typeof i?i.call(null!=e?e:l.nullContext||{},{name:"key",hash:{},data:t,loc:{start:{line:7,column:19},end:{line:7,column:27}}}):i))+'">'+s(l.lambda(e,e))+"</option>\n"},compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s=l.lambda,u=l.escapeExpression;return"<label>"+u(s(null!=(i=null!=e?e.details:e)?i.time:i,e))+'\n<input type="time" class="'+u(s(null!=(i=null!=e?e.details:e)?i.class_name:i,e))+'" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][time]" value="'+u(s(null!=(i=null!=e?e.details:e)?i.time_value:i,e))+'">\n</label>\n<label>'+u(s(null!=(i=null!=e?e.details:e)?i.day_number:i,e))+'</label>\n<select class="wpo_day_number" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][day_number]">\n'+(null!=(i=n.each.call(null!=e?e:l.nullContext||{},null!=(i=null!=e?e.details:e)?i.days:i,{name:"each",hash:{},fn:l.program(1,t,0),inverse:l.noop,data:t,loc:{start:{line:6,column:4},end:{line:8,column:13}}}))?i:"")+"</select>"},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.once=this.WP_Optimize_Handlebars.once||{},this.WP_Optimize_Handlebars.once.handlebars=Handlebars.template({compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s=l.lambda,u=l.escapeExpression;return"<label>"+u(s(null!=(i=null!=e?e.details:e)?i.date:i,e))+'\n<input type="date" class="'+u(s(null!=(i=null!=e?e.details:e)?i.class_name:i,e))+'" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][date]" value="'+u(s(null!=(i=null!=e?e.details:e)?i.date_value:i,e))+'" min="'+u(s(null!=(i=null!=e?e.details:e)?i.today:i,e))+'">\n</label>\n<label>'+u(s(null!=(i=null!=e?e.details:e)?i.time:i,e))+'\n<input type="time" class="'+u(s(null!=(i=null!=e?e.details:e)?i.class_name:i,e))+'" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][time]" value="'+u(s(null!=(i=null!=e?e.details:e)?i.time_value:i,e))+'">\n</label>'},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.optimizations=this.WP_Optimize_Handlebars.optimizations||{},this.WP_Optimize_Handlebars.optimizations.handlebars=Handlebars.template({1:function(l,e,n,a,t){var i,s=null!=e?e:l.nullContext||{},u=l.hooks.helperMissing,o="function",m=l.escapeExpression;return'    <option value="'+m((i=null!=(i=n.id||(null!=e?e.id:e))?i:u,typeof i===o?i.call(s,{name:"id",hash:{},data:t,loc:{start:{line:3,column:19},end:{line:3,column:25}}}):i))+'" '+m((i=null!=(i=n.selected||(null!=e?e.selected:e))?i:u,typeof i===o?i.call(s,{name:"selected",hash:{},data:t,loc:{start:{line:3,column:27},end:{line:3,column:39}}}):i))+">"+m((i=null!=(i=n.optimization||(null!=e?e.optimization:e))?i:u,typeof i===o?i.call(s,{name:"optimization",hash:{},data:t,loc:{start:{line:3,column:40},end:{line:3,column:56}}}):i))+"</option>\n"},compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s,u=null!=e?e:l.nullContext||{};return'<select class="wpo_auto_optimizations" name="wp-optimize-auto['+l.escapeExpression((s=null!=(s=n.count||(null!=e?e.count:e))?s:l.hooks.helperMissing,"function"==typeof s?s.call(u,{name:"count",hash:{},data:t,loc:{start:{line:1,column:62},end:{line:1,column:71}}}):s))+'][optimization][]" multiple="multiple">\n'+(null!=(i=n.each.call(u,null!=e?e.optimizations:e,{name:"each",hash:{},fn:l.program(1,t,0),inverse:l.noop,data:t,loc:{start:{line:2,column:4},end:{line:4,column:13}}}))?i:"")+"</select>"},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.schedule_types=this.WP_Optimize_Handlebars.schedule_types||{},this.WP_Optimize_Handlebars.schedule_types.handlebars=Handlebars.template({1:function(l,e,n,a,t){var i,s=null!=e?e:l.nullContext||{},u=l.hooks.helperMissing,o="function",m=l.escapeExpression;return'    <option value="'+m((i=null!=(i=n.key||t&&t.key)?i:u,typeof i===o?i.call(s,{name:"key",hash:{},data:t,loc:{start:{line:3,column:19},end:{line:3,column:27}}}):i))+'" '+m((i=null!=(i=n.selected||(null!=e?e.selected:e))?i:u,typeof i===o?i.call(s,{name:"selected",hash:{},data:t,loc:{start:{line:3,column:29},end:{line:3,column:41}}}):i))+">"+m(l.lambda(e,e))+"</option>\n"},compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s,u=null!=e?e:l.nullContext||{};return'<select class="wpo_schedule_type" name="wp-optimize-auto['+l.escapeExpression((s=null!=(s=n.count||(null!=e?e.count:e))?s:l.hooks.helperMissing,"function"==typeof s?s.call(u,{name:"count",hash:{},data:t,loc:{start:{line:1,column:57},end:{line:1,column:66}}}):s))+'][schedule_type]">\n'+(null!=(i=n.each.call(u,null!=e?e.schedule_types:e,{name:"each",hash:{},fn:l.program(1,t,0),inverse:l.noop,data:t,loc:{start:{line:2,column:4},end:{line:4,column:13}}}))?i:"")+'</select>\n<div class="wpo_schedule_fields"></div>'},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.status=this.WP_Optimize_Handlebars.status||{},this.WP_Optimize_Handlebars.status.handlebars=Handlebars.template({compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s=l.lambda,u=l.escapeExpression;return'<div class="wpo_event_status">\n    <label><input type="checkbox" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][status]" value="1" '+u(s(null!=(i=null!=e?e.details:e)?i.status_value:i,e))+">"+u(s(null!=(i=null!=e?e.details:e)?i.status:i,e))+"</label>\n</div>"},useData:!0}),this.WP_Optimize_Handlebars=this.WP_Optimize_Handlebars||{},this.WP_Optimize_Handlebars.weekly=this.WP_Optimize_Handlebars.weekly||{},this.WP_Optimize_Handlebars.weekly.handlebars=Handlebars.template({1:function(l,e,n,a,t){var i,s=l.escapeExpression;return'    <option value="'+s((i=null!=(i=n.key||t&&t.key)?i:l.hooks.helperMissing,"function"==typeof i?i.call(null!=e?e:l.nullContext||{},{name:"key",hash:{},data:t,loc:{start:{line:6,column:19},end:{line:6,column:27}}}):i))+'">'+s(l.lambda(e,e))+"</option>\n"},compiler:[8,">= 4.3.0"],main:function(l,e,n,a,t){var i,s=l.lambda,u=l.escapeExpression;return"<label>"+u(s(null!=(i=null!=e?e.details:e)?i.time:i,e))+'\n<input type="time" class="'+u(s(null!=(i=null!=e?e.details:e)?i.class_name:i,e))+'" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][time]" value="'+u(s(null!=(i=null!=e?e.details:e)?i.time_value:i,e))+'">\n</label>\n<select class="wpo_week_days" name="wp-optimize-auto['+u(s(null!=(i=null!=e?e.details:e)?i.count:i,e))+'][day]">\n'+(null!=(i=n.each.call(null!=e?e:l.nullContext||{},null!=(i=null!=e?e.details:e)?i.week_days:i,{name:"each",hash:{},fn:l.program(1,t,0),inverse:l.noop,data:t,loc:{start:{line:5,column:4},end:{line:7,column:13}}}))?i:"")+"</select>"},useData:!0});