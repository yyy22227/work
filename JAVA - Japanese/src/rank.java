import java.io.*;
import java.util.*;
import java.util.Arrays;
import java.util.Comparator;


public class rank implements Comparable<rank>{
    String name;
    int score;
    static List<rank> rankMenbers = new LinkedList<rank>();
    File rank= new File("src/rank.txt");
    public rank(String name,int score){
        this.name  =name;
        this.score =score;
    }
    public int compareTo(rank other) {
        int diff = other.score - this.score ;
        return diff;
    }
}

