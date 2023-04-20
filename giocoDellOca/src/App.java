public class App {
    public static void main(String[] args) throws Exception {
        campo c= new campo();

        generaBonus g= new generaBonus(c.vettore);
        g.start();
        g.join();

        giocatore g1=new giocatore(c, "g1"), g2= new giocatore(c, "g2");
        g1.start();
        g2.start();




    }
}
