package com.example.mgilang13.temupohon;


import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.animation.AlphaAnimation;
import android.widget.Button;
import android.widget.ExpandableListView;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.squareup.picasso.NetworkPolicy;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

public class ViewPohon extends AppCompatActivity {

    RequestQueue rq;
    String contohIDPohon1 = "clTruZP6";
    String contohIDPohon2;
    private String idPohon = MainActivity.getResult();


    private ImageView fieldGambarPohon;

    TextView fieldNamaPohon, fieldNamaLatin, fieldSinonim;
    String namaPohon, namaLatin, sinonim, perawakan, biologi, habitat, potensi, stKonservasi, persebaran, gambarPohon;

    String url = "http://temupohon.com/android/tampil.php";

    private ExpandableListView listView;
    private ExpandableListAdapter listAdapter;
    private List<String> listDataHeader;
    private HashMap<String,List<String>> listHash;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viewpohon);

        Button button = (Button) findViewById(R.id.btnPesan);
        final AlphaAnimation btnSend = new AlphaAnimation(1F, 0.8F);

        button.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                v.startAnimation(btnSend);
                startActivity(new Intent(ViewPohon.this, Pesan.class));
                ViewPohon.super.finish();
            }
        });

        rq = Volley.newRequestQueue(this);
        final AlphaAnimation buttonBack = new AlphaAnimation(1F, 0.8F);
        Button backtoScan = (Button) findViewById(R.id.backtoScan);
        backtoScan.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                v.startAnimation(buttonBack);
                startActivity(new Intent(ViewPohon.this, MainActivity.class));
                ViewPohon.super.finish();
            }
        });

        fieldNamaPohon = (TextView) findViewById(R.id.namaPohon);
        fieldNamaLatin = (TextView) findViewById(R.id.namaLatin);
        fieldSinonim = (TextView) findViewById(R.id.sinonim);
        fieldGambarPohon = (ImageView) findViewById(R.id.gambarPohon);



        sendjsonrequest();

    }

    private void initData(String perawakan, String biologi, String habitat, String potensi, String stKonservasi, String persebaran) {
        listDataHeader = new ArrayList<>();
        listHash = new HashMap<>();

        listDataHeader.add("Perawakan");
        listDataHeader.add("Biologi");
        listDataHeader.add("Habitat");
        listDataHeader.add("Potensi");
        listDataHeader.add("Status Konservasi");
        listDataHeader.add("Persebaran");


        List<String> descPerawakan = new ArrayList<>();
        descPerawakan.add(perawakan);

        List<String> descBiologi = new ArrayList<>();
        descBiologi.add(biologi);

        List<String> descHabitat = new ArrayList<>();
        descHabitat.add(habitat);

        List<String> descPotensi = new ArrayList<>();
        descPotensi.add(potensi);

        List<String> descStatusKonservasi = new ArrayList<>();
        descStatusKonservasi.add(stKonservasi);

        List<String> descPersebaran = new ArrayList<>();
        descPersebaran.add(persebaran);


        listHash.put(listDataHeader.get(0), descPerawakan);
        listHash.put(listDataHeader.get(1), descBiologi);
        listHash.put(listDataHeader.get(2), descHabitat);
        listHash.put(listDataHeader.get(3), descPotensi);
        listHash.put(listDataHeader.get(4), descStatusKonservasi);
        listHash.put(listDataHeader.get(5), descPersebaran);

        ExpandableListView listView  = (ExpandableListView)findViewById(R.id.lvExp);
        listAdapter = new ExpandableListAdapter(this,listDataHeader,listHash);

        listView.setAdapter(listAdapter);

    }

    public void sendjsonrequest() {
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    for (int i = 0; i < response.length(); i++) {
                        JSONObject pohon = response.getJSONObject(i);
                        contohIDPohon2 = pohon.getString("id_pohon");


                        if (idPohon.equals(contohIDPohon2)) {

                            namaPohon = pohon.getString("nama_pohon");
                            namaLatin = pohon.getString("nama_latin");
                            sinonim = pohon.getString("sinonim");
                            perawakan = pohon.getString("perawakan");
                            biologi = pohon.getString("biologi");
                            habitat = pohon.getString("habitat");
                            potensi = pohon.getString("potensi");
                            stKonservasi = pohon.getString("status_konservasi");
                            persebaran = pohon.getString("persebaran");
                            gambarPohon = pohon.getString("nama_gambar");

                            fieldNamaPohon.setText(namaPohon);
                            fieldNamaLatin.setText(namaLatin);
                            fieldSinonim.setText(sinonim);


                            initData(perawakan, biologi, habitat, potensi, stKonservasi, persebaran);

                            Picasso.with(getApplicationContext()).load("http://temupohon.com/assets/images/uploads/gambarPohon/"+gambarPohon).networkPolicy(NetworkPolicy.NO_CACHE).into(fieldGambarPohon);

                        }

                        else if (!idPohon.equals(contohIDPohon2)&&(i == response.length()-1)) {
                            Context context = getApplicationContext();
                            CharSequence text = "ID Pohon tidak ada";
                            int duration = Toast.LENGTH_LONG;

                            Toast toast = Toast.makeText(context, text, duration);
                            toast.show();
//                            startActivity(new Intent(ViewPohon.this, MainActivity.class));
                            break;
                        }


                    }



                } catch (JSONException e) {
                    e.printStackTrace();


                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                NetworkResponse errorRes = error.networkResponse;
                String stringData = "";
                if (errorRes != null && errorRes.data != null) {
                    try {
                        stringData = new String(errorRes.data, "UTF-8");
                    } catch (UnsupportedEncodingException e) {
                        e.printStackTrace();
                    }
                }
                Log.e("Error", stringData);
            }
        });
        rq.add(jsonArrayRequest);
    }

    @Override
    public void onBackPressed() {

    }
}
