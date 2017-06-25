import java.io.*;
import javax.swing.*;
import sun.audio.AudioStream;
import sun.audio.AudioPlayer;

public class voice extends JApplet implements Runnable{
    public void run(){
        try{
            InputStream in = new FileInputStream(filetext.voicebox[filetext.voiceindex]);
            AudioStream as = new AudioStream(in);
            AudioPlayer.player.start(as);
            System.out.println("執行完成");
        }catch(Exception e){
            System.out.println("錯誤");
        }
    }
}





//public class voice extends Applet{
//    AudioClip AC;
//    public void init(){
//        try{
//            AC = getAudioClip(getCodeBase(),"src/"+"a.wav");
//            AC.play();
//        }catch(Exception e){
//            System.out.println("找不到檔案");
//        }
//    }
//    public void destory(){
//        AC.stop();
//    }
//}

//    public void voice(){
//         try{
//             player = MidiSystem.getSequencer();
//             File file = new File("src/voice/"+"a.mid");
//             Sequence sound = MidiSystem.getSequence(file);
//             player.setSequence(sound);
//             player.open();
//         }catch(Exception e){
//             System.out.println(e);
//         }
//        player.start();
//    }
