import java.util.Collections;
import javax.swing.JFrame;



public class JPgame {
    public static void main(String[] args) {
        JPfram mygame = new JPfram();
        mygame.setSize(600, 500);
        mygame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        mygame.setVisible(true);
        mygame.setResizable(false);
    }
}

