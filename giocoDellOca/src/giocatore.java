import java.util.Random;

public class giocatore extends Thread{
    int posizione;
    campo c;
    String nome;
    Random r;

    public giocatore(campo campo, String n){
        posizione=0;
        c=campo;
        nome=n;
        r= new Random();
    }

    public int lancio(){
        int lancio;
        do{
             lancio=r.nextInt(12)+1;
        }while(lancio<2);
        return lancio;
    }

    public void run(){
        while(posizione<c.vettore.length){
            int avanza=lancio();
            posizione+=avanza;
            if(posizione>c.vettore.length) break;

            if(c.vettore[posizione-1].occupata){
                posizione++;
                c.vettore[posizione-1].setOccupata(true);
            }
            else 
                c.vettore[posizione-1].setOccupata(true);
            

            
            
            posizione+=c.vettore[posizione-1].valore;
            
        }

        System.out.println(nome+" finito");
        
    }
}
