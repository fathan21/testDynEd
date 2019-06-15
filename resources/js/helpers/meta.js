export default {
	set(item) {
            document.title = item.title ;
            document.head.querySelector('meta[name=title]').title = item.title;
            $('meta[property=og\\:title]').attr('content',item.title );
            $('meta[property=og\\:url]').attr('content', window.location.href);
            
            if(item.description) {
                  document.head.querySelector('meta[name=description]').content = item.description;   
                  $('meta[property=og\\:description]').attr('content', item.description);  
            }
            if(item.keywords){
                  document.head.querySelector('meta[name=keywords]').content = item.keywords;     
            }
            $('meta[property=og\\:image]').attr('content', item.img);
            /*
            document.head.querySelector('meta[property=og:url]').content = window.location.href;
            document.head.querySelector('meta[property=og:title]').content = item.title;
            document.head.querySelector('meta[property=og:description]').content = item.description;
            document.head.querySelector('meta[property=og:img]').content = item.img;
            */

	},
}