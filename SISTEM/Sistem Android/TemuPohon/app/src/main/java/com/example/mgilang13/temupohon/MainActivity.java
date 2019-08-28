package com.example.mgilang13.temupohon;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.animation.AlphaAnimation;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.google.zxing.Result;
import com.squareup.picasso.NetworkPolicy;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;

import me.dm7.barcodescanner.zxing.ZXingScannerView;

public class MainActivity extends AppCompatActivity  implements ZXingScannerView.ResultHandler {
    private ZXingScannerView mScannerView;
    static String idPohon;
    String listIDPohon;
    RequestQueue rq;
    String url = "http://temupohon.com/android/tampil.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Button button = (Button) findViewById(R.id.button);
        final AlphaAnimation btnScan = new AlphaAnimation(1F, 0.8F);
        rq = Volley.newRequestQueue(this);

        Button btnexit = (Button) findViewById(R.id.exit);
        btnexit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               finish();
            }
        });


//        button.setOnClickListener(new View.OnClickListener(){
//            @Override
//            public void onClick(View v) {
//                v.startAnimation(btnScan);
//                startActivity(new Intent(MainActivity.this, ViewPohon.class));
//                MainActivity.super.finish();
//            }
//        });
    }

    public void onClick(View v) {
        if(!isConnected(MainActivity.this)) buildDialog(MainActivity.this).show();
        else {
            Toast.makeText(MainActivity.this,"Silahkan Scan Pohon", Toast.LENGTH_LONG).show();
            setContentView(R.layout.activity_main);
        }
        mScannerView = new ZXingScannerView(this);
        setContentView(mScannerView);
        mScannerView.setResultHandler(this);
        mScannerView.startCamera();
    }

    protected void onPause() {
        super.onPause();
        mScannerView.stopCamera();
    }

    @Override
    public void handleResult(Result result) {
        idPohon = result.getText();

//        Context context = getApplicationContext();
//        CharSequence text = idPohon;
//        int duration = Toast.LENGTH_LONG;
//
//        Toast toast = Toast.makeText(context, text, duration);
//        toast.show();
//
//        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null, new Response.Listener<JSONArray>() {
//            @Override
//            public void onResponse(JSONArray response) {
//                try {
//                    for (int i = 0; i < response.length(); i++) {
//                        JSONObject pohon = response.getJSONObject(i);
//                        listIDPohon = pohon.getString("id_pohon");
//
//                        if (idPohon.equals(listIDPohon)) {
//                            startActivity(new Intent(MainActivity.this, ViewPohon.class));
//                        }
//                        else if ((!idPohon.equals(listIDPohon))&&(i == response.length()-1)) {
//                            Context context = getApplicationContext();
//                            CharSequence text = "ID Pohon tidak ada";
//                            int duration = Toast.LENGTH_LONG;
//
//                            Toast toast = Toast.makeText(context, text, duration);
//                            toast.show();
//                            startActivity(new Intent(MainActivity.this, MainActivity.class));
//                            break;
//                        }
//                    }
//
//                } catch (JSONException e) {
//                    e.printStackTrace();
//                }
//            }
//        }, new Response.ErrorListener() {
//            @Override
//            public void onErrorResponse(VolleyError error) {
//                NetworkResponse errorRes = error.networkResponse;
//                String stringData = "";
//                if (errorRes != null && errorRes.data != null) {
//                    try {
//                        stringData = new String(errorRes.data, "UTF-8");
//                    } catch (UnsupportedEncodingException e) {
//                        e.printStackTrace();
//                    }
//                }
//                Log.e("Error", stringData);
//            }
//        });
//        rq.add(jsonArrayRequest);
        Intent i = new Intent(this, ViewPohon.class);
        startActivity(i);
    }

    public boolean isConnected(Context context) {

        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo netinfo = cm.getActiveNetworkInfo();

        if (netinfo != null && netinfo.isConnectedOrConnecting()) {
            android.net.NetworkInfo wifi = cm.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
            android.net.NetworkInfo mobile = cm.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);

            if((mobile != null && mobile.isConnectedOrConnecting()) || (wifi != null && wifi.isConnectedOrConnecting())) return true;
            else return false;
        } else
            return false;
    }

    public AlertDialog.Builder buildDialog(Context c) {

        AlertDialog.Builder builder = new AlertDialog.Builder(c);
        builder.setTitle("Tidak Ada Koneksi Internet");
        builder.setMessage("Cek Koneksi Mobile Data dan Wifi!");

        builder.setPositiveButton("Ok", new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface dialog, int which) {

                startActivity(new Intent(MainActivity.this, MainActivity.class));

            }
        });

        return builder;
    }
// Untuk mendisable button back
    public void onBackPressed() {

    }
   public static String getResult() {
        return idPohon;
    }
}
