import java.util.HashMap;

public class hashMap {
    HashMap<String, Integer> hashMap = new HashMap<String, Integer>();
    public hashMap(){
        hashMap.put("a",0);
        hashMap.put("i",1);
        hashMap.put("u",2);
        hashMap.put("e",3);
        hashMap.put("o",4);
        hashMap.put("ka",5);
        hashMap.put("ki",6);
        hashMap.put("ku",7);
        hashMap.put("ke",8);
        hashMap.put("ko",9);
        hashMap.put("sa",10);
        hashMap.put("shi",11);
        hashMap.put("su",12);
        hashMap.put("se",13);
        hashMap.put("so",14);
        hashMap.put("ta",15);
        hashMap.put("chi",16);
        hashMap.put("tsu",17);
        hashMap.put("te",18);
        hashMap.put("to",19);
        hashMap.put("na",20);
        hashMap.put("ni",21);
        hashMap.put("nu",22);
        hashMap.put("ne",23);
        hashMap.put("no",24);
        hashMap.put("ha",25);
        hashMap.put("hi",26);
        hashMap.put("fu",27);
        hashMap.put("he",28);
        hashMap.put("ho",29);
        hashMap.put("ma",30);
        hashMap.put("mi",31);
        hashMap.put("mu",32);
        hashMap.put("me",33);
        hashMap.put("mo",34);
        hashMap.put("ya",35);
        hashMap.put("yu",36);
        hashMap.put("yo",37);
        hashMap.put("ra",38);
        hashMap.put("ri",39);
        hashMap.put("ru",40);
        hashMap.put("re",41);
        hashMap.put("ro",42);
        hashMap.put("wa",43);
        hashMap.put("wo",44);
        hashMap.put("n",45);
    }
    public int get(String key){
        try{
            int a = hashMap.get(key);
            return a;
        }catch(Exception e){
            return -1;
        }
        
    }
}
