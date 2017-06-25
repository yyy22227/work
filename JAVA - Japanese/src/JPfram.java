import java.awt.*;
import java.util.*;
import javax.swing.*;
import java.io.*;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import javax.swing.ImageIcon;
import javax.swing.JLabel;
import java.awt.event.KeyAdapter;
import java.util.Random;
import javax.swing.Timer;
import javax.swing.JOptionPane;


public class JPfram extends JFrame
{
    private JButton start,stop;
    private BorderLayout layout;
    private int speed = 30;
    private JTextField text;
    private JPanel gameControl;
    private JPanel gameWindow;
    private Image [] img = new Image[6];
    private Image gameover,gameinitial,gamestop;
    private int [] x ={30,130,230,330,430,530};
    private int [] y ={0,0,0,0,0,0};
    private int lengh = 50;
    private int [] imgnum = {0,0,0,0,0,0};
    private enum status{
        GAME_INITIAL,
        GAME_START,
        GAME_PAUSE,
        GAME_OVER
    }
    status state = status.GAME_INITIAL;
    private boolean flat = true;
    hashMap hashMap = new hashMap();
    Random random = new Random();
    private int score = 0;
    JLabel showscore;
    TextArea showrank;
    String ranktext = "" ;
    String name;
    voice voice = new voice(); 
    public JPfram() {
        super("五十音");
        layout = new BorderLayout(5, 5);
        start = new JButton("開始");
        start.setEnabled(true);
        stop = new JButton("暫停");
        stop.setEnabled(false);
        start.setSelected(true);
        text = new JTextField("",5);
        
        showscore=new JLabel("目前分數："+Integer.toString(score));
        Font font1 = new Font(Font.MONOSPACED, Font.BOLD, 35);
        showscore.setFont(font1);
        showscore.setForeground(Color.RED);
        
        readrank(); //讀取檔案
        showrank = new TextArea(ranktext);
        Font font2 = new Font(Font.MONOSPACED, Font.BOLD, 20);
        showrank.setFont(font1);
        showrank.setForeground(Color.GREEN);
        
        for(int i =0;i<img.length;i++){
            imgMake(i);
            y[i] = y[i] -random.nextInt(150);
        }
        
        ImageIcon gameoverimg = new ImageIcon(getClass().getResource("gameover.jpg"));
        gameover = gameoverimg.getImage();
        ImageIcon gameinitialimg = new ImageIcon(getClass().getResource("gameinitial.jpg"));
        gameinitial = gameinitialimg.getImage();
        ImageIcon gamestopimg = new ImageIcon(getClass().getResource("gamestop.jpg"));
        gamestop = gamestopimg.getImage();
        
        
        gameControl = new JPanel();
        gameWindow = new JPanel() {
            public void paintComponent(Graphics g) {
                super.paintComponent(g);
                Graphics2D g2 =(Graphics2D ) g;
                g2.setComposite(AlphaComposite.getInstance(AlphaComposite.SRC_ATOP, 200/200.0f));
                switch(state){
                    case GAME_INITIAL:
                        showscore.setVisible(false);
                        g2.drawImage(gameinitial,0,0,600,450,this);
                        showrank.setBounds(150,150, 300, 280);
                        break;
                    case GAME_PAUSE:
                        showscore.setVisible(false);
                        g2.drawImage(gamestop,0,0,600,450,this);
                        break;
                    case GAME_OVER:
                        g2.drawImage(gameover,0,0,600,450,this);
                        showscore.setText("最終分數："+Integer.toString(score));
                        showscore.setBounds(200,250, 300, 100);
                        break;
                    case GAME_START:
                        showrank.setVisible(false);
                        for(int i=0;i<img.length;i++){
                            g2.drawImage(img[i],x[i],y[i],lengh,lengh,this);
                        }
                        break;
                }
            }
        };
        gameWindow.setBackground(Color.WHITE);
        gameWindow.setLayout(null);
        gameWindow.add(showscore);
        gameWindow.add(showrank);
        showscore.setBounds(0,0, 300, 100);
        
        gameControl.add(start);
        gameControl.add(stop);
        gameControl.add(text);
        
        start.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                if(state == status.GAME_OVER){
                    
                }
                else{
                    showscore.setVisible(true);
                    start.setEnabled(false);
                    stop.setEnabled(true);
                    text.setEnabled(true);
                    state = status.GAME_START;
                    flat = true;
                }
            }
	});
        stop.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                if(state == status.GAME_OVER){
                    for(int i =0;i<img.length;i++){
                        imgMake(i);
                        y[i] = 0;
                        y[i] = y[i] - random.nextInt(150);
                    }
                    gameWindow.setBackground(Color.WHITE);
                    state = status.GAME_INITIAL;
                    score = 0;
                    showscore.setText("目前分數："+Integer.toString(score));
                    showscore.setBounds(0,0, 300,100);
                    showrank.setVisible(true);
                    stop.setText("暫停");
                    start.setEnabled(true);
                    stop.setEnabled(false);
                    text.setEnabled(false);
                }
                else{
                    start.setEnabled(true);
                    stop.setEnabled(false);
                    text.setEnabled(false);
                    state = status.GAME_PAUSE;
                    flat = true;
                }
            }
	});
        
        TextFieldHandler handler = new TextFieldHandler();
        text.addActionListener(handler);
        
        text.addKeyListener(new KeyAdapter() {
            public void keyRlease(KeyEvent e) {
                if(e.getKeyCode()==e.VK_SPACE){
                      answer(text.getText(),1);
                      text.setText("");
                }
            }
            public void keyReleased( KeyEvent e){
                if(e.getKeyCode()==e.VK_SPACE){
                      answer(text.getText(),1);
                      text.setText("");
                }
            }
            public void keyTyped( KeyEvent e ){
            }
        });
        
        add(gameWindow, BorderLayout.CENTER);
        add(gameControl, BorderLayout.SOUTH);
        
        Timer timer = new Timer(speed, new ActionListener() {
            private void animateFSM() {
                 switch(state){
                    case GAME_INITIAL:
                        if(flat){
                            System.out.println("遊戲初始");
                            flat = false;
                        }
                        break;
                    case GAME_OVER:
                        if(flat){
                            System.out.println("遊戲結束");
                            text.setEnabled(false);
                            stop.setText("重新開始");
                            if(flat){
                                name = "無名氏";
                                name = JOptionPane.showInputDialog("起輸入名字");
                            }
                            writerank(name,score);
                            flat = false;
                        }break;
                    case GAME_START:
                        if(flat){
                          System.out.println("遊戲繼續");  
                          flat = false;
                        }
                        for(int i=0;i<y.length;i++){
                            y[i] = y[i] + 1;
                        }
                        if (y[0]>=400 || y[1]>=400 || y[2]>=400 || y[3]>=400 || y[4] >=400|| y[5] >=400){
                                state = status.GAME_OVER;
                                flat =true;
                            }
                        break;
                    case GAME_PAUSE:
                         if(flat){
                            System.out.println("遊戲暫停");
                            flat = false;
                        }
                        break;
                 }
            }
            public void actionPerformed(ActionEvent e) {
                animateFSM();
                repaint();
                switch(state){
                    case GAME_INITIAL:
                        break;
                    case GAME_OVER:
                        gameWindow.setBackground(Color.WHITE);
                        break;
                    case GAME_START:
                        break;
                    case GAME_PAUSE:
                        break;
                 }
            }
        });
        timer.start();
        
    }
    
    private void imgMake(int num){
        boolean change = false;
        do{
            change = false;
            imgnum[num] = random.nextInt(45);
            for(int i = 0;i<6;i++){    
                if(num==i){
                }
                else if(imgnum[num]==imgnum[i]){
                    change = true;
                }
            }
        }while(change);
        
        ImageIcon icon = new ImageIcon(getClass().getResource(filetext.imgbox[imgnum[num]]));
        img[num] = icon.getImage();
    }
    
    private class TextFieldHandler implements ActionListener {
        public void actionPerformed( ActionEvent e){
            answer(e.getActionCommand(),0);
            text.setText("");
        }
    }
    
    private void answer(String key,int in){
        key = key.substring(0,key.length() - in);
        boolean change=true;
        for(int i=0;i<img.length;i++){
            if(imgnum[i]== hashMap.get(key)){
                filetext.voiceindex = imgnum[i];
                voice.run();
                imgMake(i);
                score = score + 100;
                showscore.setText("目前分數："+Integer.toString(score));
                y[i] = 0 -random.nextInt(50)-80;
                change = false;
            }
        }
        if(change){
            if(score==0){
                System.out.println("無分數可扣!!!!");
            }
            else{
                score = score - 50;
                showscore.setText("目前分數："+Integer.toString(score));
            }
        }
    }
    
    
    
    public void writerank (String name,int score){
        try{
            FileWriter fw = new FileWriter("rank.txt");
            BufferedWriter output = new BufferedWriter(fw);
            rank.rankMenbers.add(new rank(name,score));
            Collections.sort(rank.rankMenbers);
            output.write("名字#成績");
            output.newLine();
            ranktext = "";
            
            for(int i =0;i<rank.rankMenbers.size();i++){
                output.write(rank.rankMenbers.get(i).name + "#" + Integer.toString(rank.rankMenbers.get(i).score));
                ranktext =ranktext + rank.rankMenbers.get(i).name + " " + Integer.toString(rank.rankMenbers.get(i).score) + "\n";
                output.newLine();
            }
            
            
            showrank.setText(ranktext);
            output.close();
            fw.close();
        }catch(Exception e){
            System.out.println(e);
        }
    }
    
    
    public void readrank(){
        boolean title = true;
        String in ;
        try{
            FileReader rd = new FileReader("rank.txt");
            BufferedReader input = new BufferedReader(rd);
            while ((in = input.readLine())!=null) {
                if (title){
                    title = false;
                }
                else{
                    String[] text= in.split("#");
                    rank.rankMenbers.add(new rank(text[0], Integer.valueOf(text[1])));
                }
            }
            
            Collections.sort(rank.rankMenbers);
            for(int a =0;a < rank.rankMenbers.size();a++){
                ranktext = ranktext + rank.rankMenbers.get(a).name + " " + Integer.toString(rank.rankMenbers.get(a).score) + "\n";
                System.out.println(a);
            }
            input.close();
            rd.close();
            
        }catch(Exception e){
            System.out.println(e);
        }
    }
}



    
    

    

