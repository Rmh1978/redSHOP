function IsNumeric(r){var e,t="0123456789",a=!0;if(0==r.length)return!1;for(i=0;i<r.length&&1==a;i++)e=r.charAt(i),-1==t.indexOf(e)&&(a=!1);return a}function isString(r){for(var e=r.value,t=e.length,a=". -,",n=0;n!=t;n++)if(aChar=e.substring(n,n+1),aChar=aChar.toUpperCase(),-1==a.indexOf(aChar)&&(aChar<"A"||aChar>"Z"))return!1;return!0}function CheckCardNumber(form){if(""!=jQuery('input:radio[name="selectedCard"]:checked').val())return!0;var tmpyear;if(form.order_payment_name.value.length>0&&0==isString(form.order_payment_name))return alert("Please do not enter Numeric value in card name."),form.order_payment_name.focus(),!1;if(0==form.order_payment_number.value.length)return alert("Please enter a Card Number."),form.order_payment_number.focus(),!1;if(0==IsNumeric(form.order_payment_number.value))return alert("Please enter Numeric value only in card number."),form.order_payment_number.focus(),!1;if(tmpyear=form.order_payment_expire_year.options[form.order_payment_expire_year.selectedIndex].value,tmpmonth=form.order_payment_expire_month.options[form.order_payment_expire_month.selectedIndex].value,!(new CardType).isExpiryDate(tmpyear,tmpmonth))return alert("This card has already expired."),!1;if(card=!1,void 0!==form.creditcard_code)if(cardlen=void 0!==form.creditcard_code.type?1:form.creditcard_code.length,cardlen>1)for(var c=0;c<cardlen;c++)form.creditcard_code[c].checked&&(card=form.creditcard_code[c].value);else form.creditcard_code.checked&&(card=form.creditcard_code);if(!card)return alert("Please Select Credit Card type"),!1;var retval=eval(card+'.checkCardNumber("'+form.order_payment_number.value+'", '+tmpyear+", "+tmpmonth+");");return cardname="",retval?!(!isNum(form.credit_card_code.value)||""==trim(form.credit_card_code.value)||"amex"==card&&4!=form.credit_card_code.value.length||"amex"!=card&&3!=form.credit_card_code.value.length)||(alert("Enter vaild Security Number."),!1):(alert("This card number is not valid."),!1)}function CardType(){var r=CardType.arguments,e=CardType.arguments.length;this.objname="object CardType";var t=e>0?r[0]:"CardObject",a=e>1?r[1]:"0,1,2,3,4,5,6,7,8,9",n=e>2?r[2]:"13,14,15,16,19";return this.setCardNumber=setCardNumber,this.setCardType=setCardType,this.setLen=setLen,this.setRules=setRules,this.setExpiryDate=setExpiryDate,this.setCardType(t),this.setLen(n),this.setRules(a),e>4&&this.setExpiryDate(r[3],r[4]),this.checkCardNumber=checkCardNumber,this.getExpiryDate=getExpiryDate,this.getCardType=getCardType,this.isCardNumber=isCardNumber,this.isExpiryDate=isExpiryDate,this.luhnCheck=luhnCheck,this}function checkCardNumber(){var r=checkCardNumber.arguments,e=checkCardNumber.arguments.length,t=e>0?r[0]:this.cardnumber,a=e>1?r[1]:this.year,n=e>2?r[2]:this.month;return this.setCardNumber(t),this.setExpiryDate(a,n),!!this.isCardNumber()&&!!this.isExpiryDate()}function getCardType(){return this.cardtype}function getExpiryDate(){return this.month+"/"+this.year}function isCardNumber(){var r=isCardNumber.arguments,e=isCardNumber.arguments.length,t=e>0?r[0]:this.cardnumber;if(!this.luhnCheck())return!1;for(var a=0;a<this.len.size;a++)if(t.toString().length==this.len[a]){for(var n=0;n<this.rules.size;n++){var i=t.substring(0,this.rules[n].toString().length);if(i==this.rules[n])return!0}return!1}return!1}function isExpiryDate(){var r=isExpiryDate.arguments,e=isExpiryDate.arguments.length;return year=e>0?r[0]:this.year,month=e>1?r[1]:this.month,!!isNum(year+"")&&(!!isNum(month+"")&&(today=new Date,expiry=new Date(year,month),!(today.getTime()>expiry.getTime())))}function isNum(r){if(r=r.toString(),0==r.length)return!1;for(var e=0;e<r.length;e++)if(r.substring(e,e+1)<"0"||r.substring(e,e+1)>"9")return!1;return!0}function luhnCheck(){var r=luhnCheck.arguments,e=luhnCheck.arguments.length,t=e>0?r[0]:this.cardnumber;if(!isNum(t))return!1;for(var a=t.length,n=1&a,i=0,s=0;s<a;s++){var d=parseInt(t.charAt(s));1&s^n||(d*=2)>9&&(d-=9),i+=d}return i%10==0}function makeArray(r){return this.size=r,this}function setCardNumber(r){return this.cardnumber=r,this}function setCardType(r){return this.cardtype=r,this}function setExpiryDate(r,e){return this.year=r,this.month=e,this}function setLen(r){0!=r.length&&null!=r||(r="13,14,15,16,19");var e=r;for(n=1;-1!=e.indexOf(",");)e=e.substring(e.indexOf(",")+1,e.length),n++;for(this.len=new makeArray(n),n=0;-1!=r.indexOf(",");){var t=r.substring(0,r.indexOf(","));this.len[n]=t,r=r.substring(r.indexOf(",")+1,r.length),n++}return this.len[n]=r,this}function setRules(r){0!=r.length&&null!=r||(r="0,1,2,3,4,5,6,7,8,9");var e=r;for(n=1;-1!=e.indexOf(",");)e=e.substring(e.indexOf(",")+1,e.length),n++;for(this.rules=new makeArray(n),n=0;-1!=r.indexOf(",");){var t=r.substring(0,r.indexOf(","));this.rules[n]=t,r=r.substring(r.indexOf(",")+1,r.length),n++}return this.rules[n]=r,this}var Cards=new makeArray(8);Cards[0]=new CardType("MasterCard","51,52,53,54,55","16");var MC=Cards[0],maestro=Cards[0];Cards[1]=new CardType("VisaCard","4","13,16");var VISA=Cards[1];Cards[2]=new CardType("AmExCard","34,37","15");var amex=Cards[2];Cards[3]=new CardType("DinersClubCard","30,36,38","14");var diners=Cards[3];Cards[4]=new CardType("DiscoverCard","6011","16");var DiscoverCard=Cards[4];Cards[5]=new CardType("enRouteCard","2014,2149","15");var enRouteCard=Cards[5];Cards[6]=new CardType("JCBCard","3088,3096,3112,3158,3337,3528","16");var jcb=Cards[6],LuhnCheckSum=Cards[7]=new CardType;